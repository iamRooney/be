<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\State;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::with(['country', 'state', 'city', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('city', fn($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'verified') {
                $query->where('verified', true);
            } elseif ($request->status === 'pending') {
                $query->where('verified', false);
            }
        }

        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }

        $companies = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => Company::count(),
            'pending' => Company::where('verified', false)->count(),
            'verified' => Company::where('verified', true)->count(),
            'inactive' => Company::where('status', false)->count(),
        ];

        $states = State::orderBy('name')->get();

        return view('admin.companies.index', compact('companies', 'stats', 'states'));
    }

    public function show(Company $company)
    {
        $company->load(['country', 'state', 'city', 'user', 'products', 'services', 'enquiries']);

        $stats = [
            'products' => $company->products()->count(),
            'services' => $company->services()->count(),
            'enquiries' => $company->enquiries()->count(),
        ];

        // Derived from this company's own records, since there is no
        // dedicated activity-log table yet.
        $activity = collect()
            ->concat($company->products->map(fn($p) => (object) [
                'label' => 'Added Product: ' . $p->name,
                'time' => $p->created_at,
            ]))
            ->concat($company->services->map(fn($s) => (object) [
                'label' => 'Added Service: ' . $s->name,
                'time' => $s->created_at,
            ]))
            ->concat($company->enquiries->map(fn($e) => (object) [
                'label' => 'Received Enquiry: ' . $e->enquiry_number,
                'time' => $e->created_at,
            ]))
            ->push((object) [
                'label' => 'Company Profile Created',
                'time' => $company->created_at,
            ])
            ->sortByDesc('time')
            ->take(6)
            ->values();

        return view('admin.companies.show', compact('company', 'stats', 'activity'));
    }

    public function toggleVerified(Company $company)
    {
        $company->verified = ! $company->verified;
        $company->save();

        return back()->with('success', $company->verified
            ? 'Company verified successfully.'
            : 'Company marked as pending.');
    }
}
