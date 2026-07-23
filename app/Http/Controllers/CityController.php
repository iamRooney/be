<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return response()->json(
            City::with('state.country')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'name' => 'required|string|max:255'
        ]);

        $city = City::create([
            'state_id' => $request->state_id,
            'name' => $request->name,
            'status' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'City created successfully.',
            'data' => $city
        ], 201);
    }

    public function show(City $city)
    {
        return response()->json(
            $city->load('state.country')
        );
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'name' => 'required|string|max:255'
        ]);

        $city->update([
            'state_id' => $request->state_id,
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'City updated successfully.',
            'data' => $city
        ]);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully.'
        ]);
    }
}
