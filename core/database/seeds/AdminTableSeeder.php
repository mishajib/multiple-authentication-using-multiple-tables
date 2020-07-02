<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Admin::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
