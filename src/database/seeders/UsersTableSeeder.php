<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者ユーザー
        User::create([
            'name'=>'管理者ユーザー',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password123'),
            'role'=>'admin',
        ]);
        // 一般ユーザー
        $users = [
            ['name' => 'ユーザー1', 'email' => 'user1@example.com'],
            ['name' => 'ユーザー2', 'email' => 'user2@example.com'],
            ['name' => 'ユーザー3', 'email' => 'user3@example.com'],
            ['name' => 'ユーザー4', 'email' => 'user4@example.com'],
            ['name' => 'ユーザー5', 'email' => 'user5@example.com'],
            ['name' => 'ユーザー6', 'email' => 'user6@example.com'],
        ];
        foreach($users as $user){
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }
    }
}
