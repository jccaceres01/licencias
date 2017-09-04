<?php

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
       * Default data seeders
       */
      $this->call(UsersTableSeeder::class);
      $this->call(CountriesTableSeeder::class);
      $this->call(ProjectsTableSeeder::class);
      $this->call(EquipmentTypesTableSeeder::class);


      /**
       * Test seeders
       */
      $this->call(EmployeesTableSeeder::class);
      $this->call(EmployeesEquipmentTypesTableSeeder::class);
      $this->call(ContactsTableSeeder::class);

    }
}
