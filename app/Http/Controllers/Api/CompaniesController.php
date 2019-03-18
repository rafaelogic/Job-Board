<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function get()
    {
        return response()->json([
            'companies' => Company::withCount('jobs')->orderBy('name', 'DESC')->get(),
        ],200);
    }

    public function getJobs(Company $company)
    {
        return response()->json([
            'company' => $company->jobs->sortBy('name', 'desc')->get(),
        ],200);
    }

    public function store(Request $request, Company $company)
    {
        $com = $company->create($this->companyData($request->name, $request->city));

        return response()->json([
            'company' => $com
        ], 200);
    }

    public function update(Request $request, Company $company)
    {
        $company->update($this->companyData($request->name, $request->city));

        return response()->json([
            'company' => $company
        ], 200);
    }

    private function categoryData($name, $city_id)
    {
        return [
            'name' => $name,
            'city_id' => $city_id,
            'slug' => str_slug($name)
        ];
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response([
            'company' => $company
        ], 202);
    }
}
