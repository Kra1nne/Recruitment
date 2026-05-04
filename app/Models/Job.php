<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'title',
        'company',
        'position',
        'salary',
        'work_status',
        'work_arrangement',
        'status',
        'description',
        'location',
        'expired_at',
        'department_id'
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'job_id', 'id');
    }
}
