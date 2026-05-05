<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = [
           [
                'dept_name'   => 'Finance',
                'status'      => 'Active',
                'description' => 'Handles budgeting, accounting, and financial planning.',
                'date'        => '2025-06-20',
                'created_at'  => now()
            ]
        ];

        DB::table('departments')->insert($department);
    }
}
