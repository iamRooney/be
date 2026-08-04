<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

/**
 * The "like a supplier" feature on the homepage — buyer-only. Sellers
 * browse from their dashboard and never see this, so nothing here needs
 * to account for a seller calling it beyond the 403 guard.
 */
class SavedCompanyController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureBuyer($request);

        $companies = $request->user()
            ->savedCompanies()
            ->with(['country', 'state', 'city'])
            ->orderByDesc('saved_companies.created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $companies,
        ]);
    }

    public function store(Request $request)
    {
        $this->ensureBuyer($request);

        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
        ]);

        $request->user()->savedCompanies()->syncWithoutDetaching([$data['company_id']]);

        return response()->json([
            'success' => true,
            'message' => 'Supplier saved.',
        ], 201);
    }

    public function destroy(Request $request, Company $company)
    {
        $this->ensureBuyer($request);

        $request->user()->savedCompanies()->detach($company->id);

        return response()->json([
            'success' => true,
            'message' => 'Supplier removed from saved list.',
        ]);
    }

    private function ensureBuyer(Request $request): void
    {
        if ($request->user()->role !== 'buyer') {
            abort(403, 'Only buyers can save suppliers.');
        }
    }
}
