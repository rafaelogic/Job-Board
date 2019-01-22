<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $guarded = [];

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
