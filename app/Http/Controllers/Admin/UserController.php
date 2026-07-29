<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('company');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => User::count(),
            'buyers' => User::where('role', 'buyer')->count(),
            'sellers' => User::where('role', 'seller')->count(),
            'suspended' => User::where('status', false)->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    public function show(User $user)
    {
        $user->load(['company', 'enquiries']);

        $stats = [
            'products' => $user->company?->products()->count() ?? 0,
            'services' => $user->company?->services()->count() ?? 0,
            'enquiries' => $user->enquiries()->count(),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    public function toggleStatus(User $user)
    {
        $user->status = ! $user->status;

        $user->save();

        return redirect()
            ->back()
            ->with('success', $user->status
                ? 'User activated successfully.'
                : 'User suspended successfully.');
    }
}
