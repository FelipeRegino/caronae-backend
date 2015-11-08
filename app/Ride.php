<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('status')->withTimestamps();
    }
}