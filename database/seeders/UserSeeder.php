<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'person_id' => 1,
                'username' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'Admin',
                'created_at' => now(),
            ],
            [
                'person_id' => 2,
                'username' => 'Hr',
                'password' => Hash::make('password'),
                'role' => 'Hr',
                'created_at' => now(),
            ]
        ];

        DB::table('users')->insert($user);
    }
}
