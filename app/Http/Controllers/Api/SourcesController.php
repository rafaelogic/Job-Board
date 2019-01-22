<?php

namespace App\Http\Controllers\Api;

use App\Source;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function get()
    {
        return response()->json([
            'sources' => Source::withCount('jobs')->orderBy('name', 'desc')->get(),
        ],200);
    }

    public function getJobs(Source $source)
    {
        return response()->json([
            'source' => $source->jobs->orderBy('name', 'desc')->get(),
        ],200);
    }

    public function store(Request $request, Source $source)
    {
        $source = $source->create($this->sourceData($request->name, $request->website));

        return response()->json([
            'source' => $source
        ], 200);
    }

    public function update(Request $request, Source $source)
    {
        $source->update($this->sourceData($request->name, $request->website));

        return response()->json([
            'source' => $source
        ], 200);
    }

    private function sourceData($name, $website)
    {
        return [
            'name' => $name,
            'website' => $website,
            'slug' => str_slug($name)
        ];
    }

    public function destroy(Source $source)
    {
        $source->delete();
        return response([
            'source' => $source
        ], 202);
    }
}
