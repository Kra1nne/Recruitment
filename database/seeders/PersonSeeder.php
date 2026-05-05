<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persons =[
            [
                'first_name'   => 'John',
                'middle_name'  => 'Mol',
                'last_name'    => 'Doe',
                'gender'       => 'M',
                'birth_date'   => '1990-01-15',
                'blood_type'   => 'O+',
                'phone_number' => '09171234567',
                'email'        => 'john.doe@example.com',
                'address'      => '123 Main St, Cebu City',
                'created_at'   => now(),
            ],
            [
                'first_name'   => 'Jane',
                'middle_name'  => 'Ann',
                'last_name'    => 'Smith',
                'gender'       => 'F',
                'birth_date'   => '1995-06-20',
                'blood_type'   => 'A-',
                'phone_number' => '09987654321',
                'email'        => 'jane.smith@example.com',
                'address'      => '456 Mango Ave, Cebu City',
                'created_at'   => now(),
            ]
        ];

        DB::table('persons')->insert($persons);
    }
}
