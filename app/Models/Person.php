<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;
    protected $table = "persons";
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birth_date',
        'blood_type',
        'phone_number',
        'email',
        'address',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id', 'id');
    }
    public function employee()
    {
        return $this->hasOne(Employee::class, 'person_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'person_id', 'id');
    }
}
