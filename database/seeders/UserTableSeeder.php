<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Create Admin
      User::create([
          'username' => 'Admin',
          'role' => 'admin',
          'email' => 'admin@admin.com',
          'password' => bcrypt('password'),
          'email_verified_at' => now() //Carbon instance
      ]);
      //Create User
      User::create([
          'username' => 'User',
          'role' => 'user',
          'email' => 'user@user.com',
          'password' => bcrypt('password'),
          'email_verified_at' => now() //Carbon instance
      ]);
    }
}
