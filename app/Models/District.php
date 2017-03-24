<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'state_id', 'name', 'code3',
    ];

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function subdistricts()
    {
        return $this->hasMany('App\Models\SubDistrict');
    }
}
