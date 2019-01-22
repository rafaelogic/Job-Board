<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Job;
use App\Helpers\DataFormat;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use App\Traits\Repeatable;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    use Repeatable;

    public function get()
    {
        return response()->json([
            new JobCollection(Job::paginate($this->results_per_page))
        ],200);
    }

    public function getBy(Job $job)
    {
        return response()->json([
            'job' => $job,
        ],200);
    }

    public function store(Request $request, Job $job)
    {
        $company_id = $this->storeCompanyData($request);

        if($company_id) {
            $job = $job->create(DataFormat::job($request, $company_id));
        }

        return response()->json([
            'job' => $job
        ], 200);
    }

    public function update(Request $request, Job $job)
    {
        $job->update($this->jobData($request));

        return response()->json([
            'job' => $job
        ], 200);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return response([
            'job' => $job->title
        ], 202);
    }
}
