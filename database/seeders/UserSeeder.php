<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parent
        $parent = User::create([
            'name' => 'Parent Test',
            'email' => 'parent@test.com',
            'password' => Hash::make('123456'),
            'pin_parent' => '1234',
        ]);

        // Child
        User::create([
            'name' => 'Child Test',
            'email' => 'child@test.com',
            'password' => Hash::make('123456'),
        ]);
    }
}