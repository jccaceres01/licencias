<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contacts;
use App\Models\Employees;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();

      foreach(Employees::all() as $employee) {
        for ($i=0; $i<rand(0, 5); $i++) {
          $relation = Contacts::$relation[rand(0, sizeof(Contacts::$relation)-1)];
          Contacts::create([
            'firstnames' => $faker->firstName().' '.$faker->firstName(),
            'lastnames' => $faker->lastName().' '.$faker->lastName(),
            'email' => $faker->email,
            'phone' => $faker->phoneNumber(),
            'cell' => $faker->phoneNumber(),
            'address' => $faker->address,
            'relation' => $relation,
            'employee_id' => $employee->id
          ]);
        }
      }
    }
}
