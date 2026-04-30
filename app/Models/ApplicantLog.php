<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantLog extends Model
{
    protected $table = 'applicant_logs';

    protected $fillable = [
        'applicant_id',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }
}
