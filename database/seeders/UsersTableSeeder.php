<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'user@mail.com',
                'password'       => '$2a$10$R3IvtmGXLX6eNDVMLP85MuU3RejGXZ1bx5KjJfUdIBHA2xrcW7NlK', //admin
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
