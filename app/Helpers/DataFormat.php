<?php

namespace App\Helpers;

class DataFormat {

    public static function company($request)
    {
        $name = $request->company['name'];
        $company = [
            'city_id' => $request->company['city_id'],
            'name' => $name,
            'email' => $request->company['email'],
            'about' => isset($request->company['about']) ? $request->company['about'] : '',
            'slug' => str_slug($name)
        ];

        return $company;
    }

    public static function job($request, $company_id)
    {
        $job_title = $request->job['title'];
        return [
            'category_id' => $request->job['category_id'],
            'city_id' => $request->job['city_id'],
            'company_id' => $company_id,
            'job_type_id' => $request->job['job_type_id'],
            'source_id' => array_key_exists('source', $request->job) ? $request->job['source']:0,
            'title' => $job_title,
            'location' => $request->job['location'],
            'description' => isset($request->job['description']) ? $request->job['description'] : '',
            'qualifications' => isset($request->job['qualifications']) ? $request->job['qualifications'] : '',
            'responsibilities' => isset($request->job['responsibilities']) ? $request->job['responsibilities'] : '',
            'howtoapply' => !isset($request->job['howtoapply']) ?: $request->job['howtoapply'],
            'sitetoapply' => array_key_exists('sitetoapply', $request->job) ? $request->job['sitetoapply'] : '',
            'slug' => str_slug($job_title . '-' . rand(100,1000000))
        ];
    }

}

