<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.enquiries.index', compact('enquiries', 'stats'));
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load(['buyer', 'company', 'product', 'service']);

        return view('admin.enquiries.show', compact('enquiry'));
    }

    /**
     * Used to toggle status (open/closed) via the existing
     * PATCH admin/enquiries/{enquiry} route from the table and show page.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        $enquiry->update(['status' => $request->status]);

        return back()->with('success', 'Enquiry status updated.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry deleted.');
    }

    // Enquiries are created by buyers via the public API, not by admins,
    // so these are left as simple guards rather than full forms.
    public function create()
    {
        return redirect()->route('admin.enquiries.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.enquiries.index');
    }

    public function edit(Enquiry $enquiry)
    {
        return redirect()->route('admin.enquiries.show', $enquiry);
    }
}
