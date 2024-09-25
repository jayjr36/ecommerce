<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create an Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@breezeway.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Make sure you have a role column in your users table
        ]);

        // Create Customer Users
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@breezeway.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@breezeway.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }

}
