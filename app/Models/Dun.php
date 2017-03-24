<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dun extends Model
{
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function parliament()
    {
        return $this->belongsTo('App\Models\Parliamnet');
    }
}
