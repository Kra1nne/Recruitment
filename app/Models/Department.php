<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';

    protected $fillable = [
        'dept_name',
        'status',
        'description',
        'date'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }
}
