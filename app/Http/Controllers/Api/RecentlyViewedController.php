<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecentlyViewedProduct;
use Illuminate\Http\Request;

/**
 * Tracks products a buyer has looked at, for the "Recently Viewed" dashboard
 * section. Sellers never call this — the product-detail page only fires the
 * tracker for buyers.
 */
class RecentlyViewedController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureBuyer($request);

        $views = RecentlyViewedProduct::where('user_id', $request->user()->id)
            ->with(['product.company', 'product.category'])
            ->orderByDesc('viewed_at')
            ->limit(20)
            ->get()
            ->filter(fn ($view) => $view->product !== null)
            ->values();

        return response()->json([
            'success' => true,
            'data' => $views,
        ]);
    }

    public function store(Request $request)
    {
        $this->ensureBuyer($request);

        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // updateOrCreate so repeat views bump viewed_at instead of piling up
        // duplicate rows for the same product.
        RecentlyViewedProduct::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'product_id' => $data['product_id'],
            ],
            [
                'viewed_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
        ], 201);
    }

    private function ensureBuyer(Request $request): void
    {
        if ($request->user()->role !== 'buyer') {
            abort(403, 'Only buyers have a recently-viewed list.');
        }
    }
}
