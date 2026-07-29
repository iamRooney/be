<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Enquiry::with(['buyer', 'company', 'product', 'service']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            if ($request->type === 'product') {
                $query->whereNotNull('product_id');
            } elseif ($request->type === 'service') {
                $query->whereNotNull('service_id');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('enquiry_number', 'like', "%{$search}%")
                    ->orWhereHas('buyer', fn($b) => $b->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('company', fn($c) => $c->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('product', fn($p) => $p->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('service', fn($s) => $s->where('name', 'like', "%{$search}%"));
            });
        }

        $enquiries = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Enquiry::count(),
            'open' => Enquiry::where('status', 'open')->count(),
            'closed' => Enquiry::where('status', 'closed')->count(),
            'today' => Enquiry::whereDate('created_at', today())->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $enquiries,
            'stats' => $stats,
        ]);
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load(['buyer', 'company', 'product', 'service']);

        return response()->json([
            'success' => true,
            'data' => $enquiry,
        ]);
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        $enquiry->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Enquiry status updated.',
            'data' => $enquiry->fresh()->load(['buyer', 'company', 'product', 'service']),
        ]);
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enquiry deleted.',
        ]);
    }
}
