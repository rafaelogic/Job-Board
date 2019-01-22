<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Job;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function get()
    {
        return response()->json([
            'cities' => City::withCount('jobs')->orderBy('name', 'ASC')->get(),
        ],200);
    }

    public function getJobs(City $city)
    {
        $collection = new JobCollection(
            Job::where(['city_id' => $city->id])->paginate($this->results_per_page)
        );
        return response()->json([
            'collection' => $collection,
            'city' => $city,
        ],200);
    }

    public function store(Request $request, City $city)
    {
        $c = $city->create($this->cityData($request->name));

        return response()->json([
            'city' => $c
        ], 200);
    }

    public function update(Request $request, City $city)
    {
        $city->update($this->cityData($request->name));

        return response()->json([
            'city' => $city
        ], 200);
    }

    private function cityData($name)
    {
        return [
            'name' => $name,
            'slug' => str_slug($name)
        ];
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response([
            'city' => $city
        ], 202);
    }
}
