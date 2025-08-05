<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'dummy', 'email' => 'dummy@gmail.com', 'password' => 'Admin@123'],
            ['name' => 'user', 'email' => 'user@gmail.com', 'password' => 'Admin@123'],
            ['name' => 'support', 'email' => 'support@gmail.com', 'password' => 'Admin@123'],
            ['name' => 'sam', 'email' => 'sam@gmail.com', 'password' => 'Admin@123'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']), 
            ]);
        }
    }
}
