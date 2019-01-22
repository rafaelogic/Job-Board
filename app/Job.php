<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    protected $with = ['category', 'city', 'company', 'job_type', 'source'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function job_type()
    {
        return $this->belongsTo('App\JobType');
    }

    public function source()
    {
        return $this->belongsTo('App\Source');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
