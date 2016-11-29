<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // User 1 - admin
      DB::table('users')->insert([
          'username' => 'admin',
          'name' => 'Nama Admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('admin'),
          'phone' => '012345678',
          'designation' => 'Admin',
          'role' => 'admin',
          'department_id' => '1'
      ]);

      // User 2 - staff
      DB::table('users')->insert([
          'username' => 'staff',
          'name' => 'Nama Staff',
          'email' => 'staff@gmail.com',
          'password' => bcrypt('staff'),
          'phone' => '012345678',
          'designation' => 'Staff',
          'role' => 'staff',
          'department_id' => '2'
      ]);

    }
}
