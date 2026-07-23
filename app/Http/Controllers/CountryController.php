<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(Country::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5'
        ]);

        if (Country::where('code', strtoupper($request->code))->exists()) {

            return response()->json([
                'success' => false,
                'message' => 'Country already exists.'
            ], 422);
        }

        $country = Country::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'status' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Country created successfully.',
            'data' => $country
        ], 201);
    }

    public function show(Country $country)
    {
        return response()->json($country);
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5'
        ]);

        if (
            Country::where('code', strtoupper($request->code))
            ->where('id', '!=', $country->id)
            ->exists()
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Country code already exists.'
            ], 422);
        }

        $country->update([
            'name' => $request->name,
            'code' => strtoupper($request->code)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Country updated successfully.',
            'data' => $country
        ]);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json([
            'success' => true,
            'message' => 'Country deleted successfully.'
        ]);
    }
}
