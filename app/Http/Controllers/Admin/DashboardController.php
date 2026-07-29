<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'companies' => Company::count(),
            'pending_companies' => Company::where('verified', false)->count(),
            'buyers' => User::where('role', 'buyer')->count(),
            'sellers' => User::where('role', 'seller')->count(),
            'pending_products' => Product::where('status', 'pending')->count(),
            'pending_services' => Service::where('status', 'pending')->count(),
        ];

        $approvals = [
            'companies' => Company::where('verified', false)->count(),
            'products' => Product::where('status', 'pending')->count(),
            'services' => Service::where('status', 'pending')->count(),
        ];

        // Last 6 months growth (including current month)
        $months = collect(range(5, 0))->map(fn($i) => Carbon::now()->subMonths($i)->startOfMonth());

        $monthlyCounts = function (string $model) use ($months) {
            return $months->map(function (Carbon $month) use ($model) {
                return $model::whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count();
            });
        };

        $analytics = [
            'labels' => $months->map(fn(Carbon $m) => $m->format('M')),
            'companies' => $monthlyCounts(Company::class),
            'products' => $monthlyCounts(Product::class),
            'services' => $monthlyCounts(Service::class),
        ];

        $recentCompanies = Company::latest()->take(4)->get();

        $recentEnquiries = Enquiry::with(['buyer', 'company'])->latest()->take(3)->get();

        $recentProducts = Product::latest()->take(2)->get();
        $recentServices = Service::latest()->take(2)->get();

        $recentListings = $recentProducts->map(fn($p) => (object) [
            'name' => $p->name,
            'type' => 'Product',
            'status' => ucfirst($p->status),
            'created_at' => $p->created_at,
        ])->concat($recentServices->map(fn($s) => (object) [
            'name' => $s->name,
            'type' => 'Service',
            'status' => ucfirst($s->status),
            'created_at' => $s->created_at,
        ]))->sortByDesc('created_at')->take(4)->values();

        // Derived activity feed from the latest real records across models
        // (there is no dedicated activity-log table yet, so this is assembled
        // from each model's own timestamps rather than a true audit trail).
        $recentActivities = collect()
            ->concat(Company::where('verified', true)->latest('updated_at')->take(2)->get()->map(fn($c) => (object) [
                'icon' => 'bi-check-circle-fill text-success',
                'title' => 'Company Verified',
                'subtitle' => $c->name,
                'time' => $c->updated_at,
            ]))
            ->concat(Product::where('status', 'approved')->latest('updated_at')->take(2)->get()->map(fn($p) => (object) [
                'icon' => 'bi-box-fill text-primary',
                'title' => 'Product Approved',
                'subtitle' => $p->name,
                'time' => $p->updated_at,
            ]))
            ->concat(User::where('role', 'seller')->latest()->take(2)->get()->map(fn($u) => (object) [
                'icon' => 'bi-person-plus-fill text-info',
                'title' => 'New Seller Registered',
                'subtitle' => $u->name,
                'time' => $u->created_at,
            ]))
            ->sortByDesc('time')
            ->take(4)
            ->values();

        return view('admin.dashboard.index', compact(
            'stats',
            'approvals',
            'analytics',
            'recentCompanies',
            'recentEnquiries',
            'recentListings',
            'recentActivities'
        ));
    }
}
