<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicants';
    
    protected $fillable = [
        'person_id',
        'job_id',
        'date',
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
    public function applicantLogs()
    {
        return $this->hasMany(ApplicantLog::class, 'applicant_id', 'id');
    }
    public function latestApplicantLogs()
    {
        return $this->hasOne(ApplicantLog::class)->latestOfMany();
    }

    public function applicantStatus(): string
    {
        return match($this->status){
            'Accepted' => 'text-bg-success',
            'Rejected' => 'text-bg-danger',
            default => 'text-bg-primary'
        };
    }
}
