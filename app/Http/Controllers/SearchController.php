<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255'
        ]);

        $query = trim($request->q ?? '');
        $location = trim($request->location ?? '');

        return response()->json([
            'success' => true,
            'query' => $query,

            'products' => $this->products($query, $location),

            'services' => $this->services($query, $location),

            'companies' => $this->companies($query, $location),

            'locations' => $this->locations($query)
        ]);
    }

    private function products($query, $location)
    {
        return Product::with([
            'company',
            'category'
        ])

            ->where('status', 'approved')

            ->when($query, function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {

                    $inner->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('short_description', 'LIKE', "%{$query}%");
                });
            })

            ->when($location, function ($q) use ($location) {

                $q->whereHas('company.city', function ($city) use ($location) {

                    $city->where('name', 'LIKE', "%{$location}%");
                });
            })

            ->limit(8)

            ->get();
    }

    private function services($query, $location)
    {
        return Service::with([
            'company',
            'category'
        ])

            ->where('status', 'approved')

            ->when($query, function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {

                    $inner->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('short_description', 'LIKE', "%{$query}%");
                });
            })

            ->when($location, function ($q) use ($location) {

                $q->whereHas('company.city', function ($city) use ($location) {

                    $city->where('name', 'LIKE', "%{$location}%");
                });
            })

            ->limit(8)

            ->get();
    }

    private function companies($query, $location)
    {
        return Company::with([
            'country',
            'state',
            'city'
        ])

            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })

            ->when($location, function ($q) use ($location) {

                $q->whereHas('city', function ($city) use ($location) {

                    $city->where('name', 'LIKE', "%{$location}%");
                });
            })

            ->limit(8)

            ->get();
    }

    private function locations($query)
    {
        return [

            'countries' => Country::where('name', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'states' => State::with('country')
                ->where('name', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'cities' => City::with('state.country')
                ->where('name', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()

        ];
    }
}
