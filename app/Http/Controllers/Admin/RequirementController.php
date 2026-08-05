<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index(Request $request)
    {
        $query = Requirement::with(['buyer', 'category', 'acceptedByCompany']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('requirement_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhereHas('buyer', fn($b) => $b->where('name', 'like', "%{$search}%"));
            });
        }

        $requirements = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Requirement::count(),
            'open' => Requirement::where('status', 'open')->count(),
            'accepted' => Requirement::where('status', 'accepted')->count(),
            'today' => Requirement::whereDate('created_at', today())->count(),
        ];

        $categories = \App\Models\Category::orderBy('name')->get();

        return view('admin.requirements.index', compact('requirements', 'stats', 'categories'));
    }

    public function show(Requirement $requirement)
    {
        $requirement->load(['buyer', 'category', 'acceptedByCompany']);

        return view('admin.requirements.show', compact('requirement'));
    }

    /**
     * Used to close/reopen a requirement from the admin side — e.g. if it's
     * spam, stale, or needs to be pulled from sellers' view manually.
     */
    public function update(Request $request, Requirement $requirement)
    {
        $request->validate([
            'status' => 'required|in:open,accepted,closed',
        ]);

        $requirement->update(['status' => $request->status]);

        return back()->with('success', 'Requirement status updated.');
    }

    public function destroy(Requirement $requirement)
    {
        $requirement->delete();

        return redirect()
            ->route('admin.requirements.index')
            ->with('success', 'Requirement deleted.');
    }

    // Requirements are posted by buyers via the public API, not by admins,
    // so these are left as simple guards rather than full forms.
    public function create()
    {
        return redirect()->route('admin.requirements.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.requirements.index');
    }

    public function edit(Requirement $requirement)
    {
        return redirect()->route('admin.requirements.show', $requirement);
    }
}
