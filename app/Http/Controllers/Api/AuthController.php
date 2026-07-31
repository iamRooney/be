<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Send OTP
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
            'mode' => ['required', 'in:login,register'],
        ]);

        $existingUser = User::where('phone', $request->phone)->first();

        if ($request->mode === 'login' && !$existingUser) {
            return response()->json([
                'success' => false,
                'message' => 'No account found with this number. Please register first.',
            ], 404);
        }

        if (
            $request->mode === 'register'
            && $existingUser
            && $existingUser->is_profile_completed
        ) {
            return response()->json([
                'success' => false,
                'message' => 'This number is already registered. Please login instead.',
            ], 409);
        }

        $otp = rand(1000, 9999);

        $user = $existingUser ?? User::create([
            'phone' => $request->phone,
            'name' => 'New User',
            'status' => true,
        ]);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.',
            'data' => [
                'phone' => $user->phone,
                'otp' => $otp, // Remove this in production
                'expires_at' => $user->otp_expires_at,
            ],
        ]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
            'otp' => ['required', 'digits:4'],
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        if ($user->otp !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        if (Carbon::now()->gt($user->otp_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired.',
            ], 400);
        }

        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'otp_verified_at' => now(),
        ]);

        $token = $user->createToken('exbhex-api')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ]);
    }

    /**
     * Logged-in User
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ]);
    }
}
