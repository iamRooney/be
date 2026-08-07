<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function complete(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $user = $request->user();

            $request->validate([
                'role' => 'required|in:buyer,seller',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'profile_image' => 'nullable|image|max:2048', // 2MB
            ]);

            $profileImagePath = $user->profile_image;

            if ($request->hasFile('profile_image')) {

                // Remove the old image so uploads don't pile up
                if ($profileImagePath) {
                    Storage::disk('public')->delete($profileImagePath);
                }

                $profileImagePath = $request->file('profile_image')
                    ->store('profile-images', 'public');
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'profile_image' => $profileImagePath,
            ]);

            if ($request->role === 'buyer') {

                $user->update([
                    'is_profile_completed' => true,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Buyer profile completed successfully.',
                    'data' => $user,
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Seller Validation
        |--------------------------------------------------------------------------
        */

            $request->validate([
                'company_name' => 'required|string|max:255',
                'country_id' => 'required|exists:countries,id',
                'state_id' => 'required|exists:states,id',
                'city_id' => 'required|exists:cities,id',

                'website' => 'nullable|string|max:255',
                'gst_number' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'years_in_business' => 'nullable|integer|min:0',
            ]);

            Company::create([
                'user_id' => $user->id,

                'name' => $request->company_name,

                'slug' => Str::slug($request->company_name),

                'country_id' => $request->country_id,

                'state_id' => $request->state_id,

                'city_id' => $request->city_id,

                'phone' => $user->phone,

                'email' => $user->email,

                'website' => $request->website,

                'gst_number' => $request->gst_number,

                'description' => $request->description,

                'address' => $request->address,

                'years_in_business' => $request->years_in_business ?? 0,

                // For sellers, the image uploaded on this screen represents
                // their company logo, not a personal user avatar.
                'logo' => $profileImagePath,
            ]);

            $user->update([
                'is_profile_completed' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Seller profile completed successfully.',
                'data' => $user,
            ]);
        });
    }
}
