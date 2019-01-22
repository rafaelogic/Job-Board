<?php

namespace App\Http\Controllers\Api;

use App\Job;
use App\JobType;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use Illuminate\Http\Request;

class JobTypesController extends Controller
{
    public function get()
    {
        return response()->json([
            'jobTypes' => JobType::withCount('jobs')->orderBy('name', 'ASC')->get(),
        ],200);
    }
    
    public function getJobs(JobType $jobType)
    {
        $collection = new JobCollection(
            Job::where(['job_type_id' => $jobType->id])->paginate($this->results_per_page)
        );

        return response()->json([
            'collection' => $collection,
            'jobType' => $jobType,

        ],200);
    }

    public function store(Request $request, JobType $jobType)
    {
        $jobType = $jobType->create($this->jobTypeData($request->name, $request->class));

        return response()->json([
            'jobType' => $jobType
        ], 200);
    }

    public function update(Request $request, JobType $jobType)
    {
        $jobType->update($this->jobTypeData($request->name, $request->class));

        return response()->json([
            'jobType' => $jobType
        ], 200);
    }

    private function jobTypeData($name, $class)
    {
        return [
            'name' => $name,
            'class' => $class,
            'slug' => str_slug($name)
        ];
    }

    public function destroy(JobType $jobType)
    {
        $jobType->delete();
        return response([
            'jobType' => $jobType
        ], 202);
    }
}
