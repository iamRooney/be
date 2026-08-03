<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(
            Company::with(['country', 'state', 'city'])
                ->latest()
                ->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'required|string|max:20',

            'website' => 'nullable|string',
            'gst_number' => 'nullable|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string',

            'years_in_business' => 'nullable|integer',
            'annual_turnover' => 'nullable|string',
            'staff_count' => 'nullable|integer',
            'response_rate' => 'nullable|integer',
            'verified' => 'boolean',
            'status' => 'boolean'
        ]);

        $company = Company::create([
            'user_id' => $request->user()->id,


            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,

            'name' => $request->name,
            'slug' => Str::slug($request->name),

            'email' => $request->email,
            'phone' => $request->phone,

            'website' => $request->website,
            'gst_number' => $request->gst_number,
            'description' => $request->description,
            'address' => $request->address,

            'years_in_business' => $request->years_in_business ?? 0,
            'annual_turnover' => $request->annual_turnover,
            'staff_count' => $request->staff_count ?? 0,
            'response_rate' => $request->response_rate ?? 100,

            'verified' => $request->verified ?? false,
            'status' => $request->status ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Company created successfully.',
            'data' => $company
        ], 201);
    }

    public function show(string $slug)
    {
        $company = Company::with(['country', 'state', 'city'])
            ->withCount([
                'products as approved_products_count' => function ($query) {
                    $query->where('status', 'approved');
                },
            ])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return response()->json($company);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'phone' => 'required|string|max:20',
        ]);

        $company->update([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,

            'name' => $request->name,
            'slug' => Str::slug($request->name),

            'email' => $request->email,
            'phone' => $request->phone,

            'website' => $request->website,
            'gst_number' => $request->gst_number,
            'description' => $request->description,
            'address' => $request->address,

            'years_in_business' => $request->years_in_business,
            'annual_turnover' => $request->annual_turnover,
            'staff_count' => $request->staff_count,
            'response_rate' => $request->response_rate,

            'verified' => $request->verified,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Company updated successfully.',
            'data' => $company
        ]);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Company deleted successfully.'
        ]);
    }
}
