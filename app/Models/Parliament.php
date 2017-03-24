<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parliament extends Model
{
    public function duns()
    {
        return $this->hasMany('App\Models\Dun');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
}
