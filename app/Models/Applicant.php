<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicants';
    
    protected $fillable = [
        'person_id',
        'job_id',
        'end_date',
        'status'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
