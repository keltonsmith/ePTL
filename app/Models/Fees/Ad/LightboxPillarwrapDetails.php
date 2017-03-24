<?php
/**
 * Created by PhpStorm.
 * User: ZEUS
 * Date: 3/6/2017
 * Time: 12:48 AM
 */

namespace App\Models\Fees\Ad;

use Illuminate\Database\Eloquent\Model;

class LightboxPillarwrapDetails extends Model
{
    protected $fillable = [
        'application_id', 'column_code', 'from', 'up'
    ];

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }


}