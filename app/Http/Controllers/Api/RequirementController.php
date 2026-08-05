<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * "Post Your Requirement" — a buyer posts what they're sourcing (e.g.
 * "Potato Snacks") and it's shown to every seller whose company has a
 * product/service listed under that same category. First seller to
 * accept gets the order; everyone else stops seeing it as open.
 *
 * Note: accepting here only flips the requirement's status and records
 * who won it — it does not message the buyer. That handshake will move
 * through the messaging API once it exists.
 */
class RequirementController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'seller') {
            return $this->indexForSeller($user);
        }

        // Buyer: the requirements they've posted, and who (if anyone) won each one.
        $requirements = Requirement::with(['category:id,name,slug', 'acceptedByCompany:id,name,slug,logo'])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $requirements]);
    }

    /**
     * Open leads matching the seller's categories, PLUS anything this
     * seller's own company has already accepted — accepted requirements
     * must stay visible instead of disappearing once they flip out of
     * 'open' status.
     */
    private function indexForSeller($user)
    {
        $categoryIds = $this->sellerCategoryIds($user->id);
        $company = Company::where('user_id', $user->id)->first();

        $requirements = Requirement::with(['category:id,name,slug', 'buyer:id,name,phone'])
            ->where(function ($query) use ($categoryIds, $company) {
                $query->where(function ($open) use ($categoryIds) {
                    $open->whereIn('category_id', $categoryIds)->where('status', 'open');
                });

                if ($company) {
                    $query->orWhere('accepted_by_company_id', $company->id);
                }
            })
            ->orderByDesc('created_at')
            ->get();

        // Only reveal the buyer's phone number once *this* seller has won
        // the requirement — everyone else just sees it's open.
        $requirements->each(function ($requirement) use ($company) {
            $wonByThisCompany = $company && $requirement->accepted_by_company_id === $company->id;

            if (!$wonByThisCompany && $requirement->buyer) {
                $requirement->buyer->makeHidden('phone');
            }
        });

        return response()->json(['success' => true, 'data' => $requirements]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'buyer') {
            abort(403, 'Only buyers can post a requirement.');
        }

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string|max:50',
            // Optional — the buyer's account phone is what sellers see once
            // they accept. This is just a backup number in case that one
            // doesn't pick up.
            'alternate_phone' => 'nullable|string|max:20',
        ]);

        $requirement = Requirement::create([
            'user_id' => $user->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'quantity' => $data['quantity'],
            'unit' => $data['unit'] ?? 'Pieces',
            'alternate_phone' => $data['alternate_phone'] ?? null,
            'status' => 'open',
        ]);

        $matchedSellers = DB::table('products')->where('category_id', $data['category_id'])->pluck('company_id')
            ->merge(
                DB::table('services')->where('category_id', $data['category_id'])->pluck('company_id')
            )
            ->unique()
            ->count();

        return response()->json([
            'success' => true,
            'message' => $matchedSellers > 0
                ? "Requirement posted and sent to {$matchedSellers} matching supplier(s)."
                : 'Requirement posted. No suppliers list this category yet, but it stays open for new ones.',
            'data' => $requirement->load('category:id,name,slug'),
        ], 201);
    }

    /**
     * First seller to accept wins the order — guarded with a row lock so two
     * simultaneous accepts can't both succeed.
     */
    public function accept(Request $request, Requirement $requirement)
    {
        $user = $request->user();

        if ($user->role !== 'seller') {
            abort(403, 'Only sellers can accept a requirement.');
        }

        $company = Company::where('user_id', $user->id)->first();

        if (!$company) {
            abort(403, 'Complete your company profile before accepting requirements.');
        }

        if (!$this->sellerMatchesRequirement($user->id, $requirement)) {
            abort(403, 'This requirement is outside what your company lists.');
        }

        $accepted = DB::transaction(function () use ($requirement, $company) {

            $locked = Requirement::where('id', $requirement->id)->lockForUpdate()->first();

            if ($locked->status !== 'open') {
                return null;
            }

            $locked->update([
                'status' => 'accepted',
                'accepted_by_company_id' => $company->id,
                'accepted_at' => now(),
            ]);

            return $locked;
        });

        if (!$accepted) {
            return response()->json([
                'success' => false,
                'message' => 'This requirement has already been accepted by another supplier.',
            ], 409);
        }

        return response()->json([
            'success' => true,
            'message' => 'Requirement accepted — you got the order first.',
            'data' => $accepted->load(['category:id,name,slug', 'buyer:id,name,phone']),
        ]);
    }

    /**
     * Category ids a seller's company matches — both the exact ids their
     * products/services are listed under, AND any other category row that
     * shares the same name. `categories.name` isn't unique (only `slug`
     * is), so a buyer's requirement and a seller's product can end up
     * pointing at two different rows for what is really the same category
     * — without this, those requirements would never show up for the
     * seller even though the categories look identical everywhere.
     */
    private function sellerCategoryIds(int $userId)
    {
        $companyIds = Company::where('user_id', $userId)->pluck('id');

        $directIds = DB::table('products')
            ->whereIn('company_id', $companyIds)
            ->pluck('category_id')
            ->merge(
                DB::table('services')->whereIn('company_id', $companyIds)->pluck('category_id')
            )
            ->unique();

        $names = DB::table('categories')
            ->whereIn('id', $directIds)
            ->pluck('name')
            ->unique();

        $namedIds = DB::table('categories')
            ->whereIn('name', $names)
            ->pluck('id');

        return $directIds->merge($namedIds)->unique();
    }

    /**
     * Significant lowercase words pulled from a seller's product/service
     * names (stop words and short words dropped, naive plural stripping),
     * used to catch requirements whose title matches a seller's product
     * even when the category doesn't line up — e.g. a "Cat food" product
     * mistakenly listed under Healthcare instead of Food & Beverage should
     * still see a "Cat foods" requirement.
     */
    private function sellerProductWords(int $userId)
    {
        $companyIds = Company::where('user_id', $userId)->pluck('id');

        $names = DB::table('products')->whereIn('company_id', $companyIds)->pluck('name')
            ->merge(DB::table('services')->whereIn('company_id', $companyIds)->pluck('name'));

        $stopWords = ['the', 'and', 'for', 'with', 'pack', 'set', 'new'];

        return $names
            ->flatMap(fn ($name) => preg_split('/[^a-z0-9]+/i', strtolower($name)))
            ->map(fn ($word) => rtrim($word, 's'))
            ->filter(fn ($word) => strlen($word) >= 3 && !in_array($word, $stopWords, true))
            ->unique()
            ->values();
    }

    /**
     * Whether a seller can see/accept a given requirement — same rule used
     * for both the dashboard list and the accept-authorization check:
     * category match OR product-name word overlap with the title.
     */
    private function sellerMatchesRequirement(int $userId, Requirement $requirement): bool
    {
        if ($this->sellerCategoryIds($userId)->contains($requirement->category_id)) {
            return true;
        }

        $productWords = $this->sellerProductWords($userId);

        $titleWords = collect(preg_split('/[^a-z0-9]+/i', strtolower($requirement->title)))
            ->map(fn ($word) => rtrim($word, 's'))
            ->filter(fn ($word) => strlen($word) >= 3);

        return $titleWords->intersect($productWords)->isNotEmpty();
    }
}
