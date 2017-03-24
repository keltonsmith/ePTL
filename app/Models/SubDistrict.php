<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'district_id', 'name',
    ];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
}
