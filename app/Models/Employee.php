<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'person_id',
        'employee_id',
        'start_date',
        'end_date',
        'position',
        'salary',
        'work_status',
        'work_arrangement',
    ];

    public function department()
    {
        return  $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
