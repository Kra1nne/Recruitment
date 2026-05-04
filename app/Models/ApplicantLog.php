<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantLog extends Model
{
    protected $table = 'applicant_logs';

    protected $fillable = [
        'applicant_id',
        'assessment_type',
        'date',
        'source_type',
        'notes',
        'created_at',
        'updated_at'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }
}
