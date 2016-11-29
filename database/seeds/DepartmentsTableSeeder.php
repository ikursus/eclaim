<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Department 1
      DB::table('departments')->insert([
          'name' => 'IT',
      ]);

      // Department 2
      DB::table('departments')->insert([
          'name' => 'Financial'
      ]);
    }
}
