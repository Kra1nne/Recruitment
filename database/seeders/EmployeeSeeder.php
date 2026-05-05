<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = [
            [
                'department_id' => 1,
                'person_id' => 1,
                'employee_id' => 'EMP_001',
                'start_date' => now()->toDateString(),
                'end_date' => null,
                'position' => 'Manager',
                'salary' => 10000,
                'work_status' => 'Contract',
                'work_arrangement' => 'Remote',
            ],
            [
                'department_id' => 1,
                'person_id' => 2,
                'employee_id' => 'EMP_002',
                'start_date' => now()->toDateString(),
                'end_date' => null,
                'position' => 'Manger Assistant',
                'salary' => 10000,
                'work_status' => 'Contract',
                'work_arrangement' => 'Remote',
            ]
        ];

        DB::table('employees')->insert($employee);
    }
}
