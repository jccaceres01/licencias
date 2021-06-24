<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /**
       * Default test data seeders
       */
      $this->call(UsersTableSeeder::class);
      $this->call(CountriesTableSeeder::class);
      $this->call(ProjectsTableSeeder::class);
      $this->call(EquipmentTypesTableSeeder::class);
      $this->call(EmployeesTableSeeder::class);
      $this->call(GroupsTableSeeder::class);
      $this->call(EmployeesEquipmentTypesTableSeeder::class);
      $this->call(ContactsTableSeeder::class);
      $this->call(CoursesTableSeeder::class);
      $this->call(EmployeesCoursesTableSeeder::class);
      $this->call(PermissionsTableSeeder::class);

    }
}
