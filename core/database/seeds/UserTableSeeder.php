<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'name' => 'General User',
            'username' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
        ]);
    }
}
