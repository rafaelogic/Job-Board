<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Job;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function get()
    {
        return response()->json([
            'categories' => Category::withCount('jobs')->orderBy('name', 'ASC')->get(),
        ],200);
    }

    public function getJobs(Category $category)
    {
        $collection = new JobCollection(
            Job::where(['category_id' => $category->id])->paginate($this->results_per_page)
        );
        
        return response()->json([
            'collection' => $collection,
            'category' => $category,
        ],200);
    }

    public function store(Request $request, Category $category)
    {
        $cat = $category->create($this->categoryData($request->name));

        return response()->json([
            'category' => $cat
        ], 200);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($this->categoryData($request->name));

        return response()->json([
            'category' => $category
        ], 200);
    }

    private function categoryData($name)
    {
        return [
            'name' => $name,
            'slug' => str_slug($name)
        ];
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response([
            'category' => $category
        ], 202);
    }
}
