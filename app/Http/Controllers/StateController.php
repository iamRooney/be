<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        return response()->json(
            State::with('country')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name'       => 'required|string|max:255',
            'code'       => 'required|string|max:10'
        ]);

        $state = State::create([
            'country_id' => $request->country_id,
            'name'       => $request->name,
            'code'       => strtoupper($request->code),
            'status'     => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'State created successfully.',
            'data'    => $state
        ], 201);
    }

    public function show(State $state)
    {
        return response()->json(
            $state->load('country')
        );
    }

    public function update(Request $request, State $state)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name'       => 'required|string|max:255',
            'code'       => 'required|string|max:10'
        ]);

        $state->update([
            'country_id' => $request->country_id,
            'name'       => $request->name,
            'code'       => strtoupper($request->code)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'State updated successfully.',
            'data'    => $state
        ]);
    }

    public function destroy(State $state)
    {
        $state->delete();

        return response()->json([
            'success' => true,
            'message' => 'State deleted successfully.'
        ]);
    }
} 
