<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [
            'visit', 'location', 'direction', 'applicant', 'concessionaire',
            'officer', 'feedback', 'status', 'project_id', 'questions'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function compliance_status() {
        return $this->hasOne('App\Models\Data\IqNotes', 'inspection_id');
    }

    public function billboard_compliance_status() {
        return $this->hasOne('App\Models\Data\IqBillNote', 'inspection_id');
    }

    public function attached_files() {
        return $this->hasMany('App\Models\Data\IqFile', 'inspection_id');
    }
}
