<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class IqFile extends Model
{
    protected $fillable = [
        'inspection_id',
        'multi_path'
    ];
}
