<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sanctum authenticates a bearer token to whichever model created it
 * (User or Admin). This middleware runs after 'auth:sanctum' and makes
 * sure the token actually belongs to an Admin before allowing access
 * to admin-only API routes.
 */
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() instanceof Admin) {

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Admin access only.',
            ], 403);
        }

        return $next($request);
    }
}
