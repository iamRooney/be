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

    private function indexForSeller($user)
    {
        $categoryIds = $this->sellerCategoryIds($user->id);

        $requirements = Requirement::with(['category:id,name,slug', 'buyer:id,name'])
            ->whereIn('category_id', $categoryIds)
            ->where('status', 'open')
            ->orderByDesc('created_at')
            ->get();

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
            'phone' => 'required|string|max:20',
        ]);

        $requirement = Requirement::create([
            'user_id' => $user->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'quantity' => $data['quantity'],
            'unit' => $data['unit'] ?? 'Pieces',
            'phone' => $data['phone'],
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

        if (!$this->sellerCategoryIds($user->id)->contains($requirement->category_id)) {
            abort(403, 'This requirement is outside the categories your company lists.');
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

    private function sellerCategoryIds(int $userId)
    {
        $companyIds = Company::where('user_id', $userId)->pluck('id');

        return DB::table('products')
            ->whereIn('company_id', $companyIds)
            ->pluck('category_id')
            ->merge(
                DB::table('services')->whereIn('company_id', $companyIds)->pluck('category_id')
            )
            ->unique();
    }
}
