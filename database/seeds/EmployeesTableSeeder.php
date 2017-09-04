<?php

use Illuminate\Database\Seeder;
use App\Employees;
use Faker\Factory as Faker;
use App\Projects;
use App\Countries;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $gender = ['M', 'F'];
      $blood = ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
      $driveLicenseCategory = [
        '01 Conductor',
        '02 Conductor',
        '03 Primera  Pesados',
        '04 Segunda  Pesados',
        '05 Especial'
      ];

      $status = ['activo', 'cacelado', 'parado'];

      for ($i=0; $i<30; $i++) {
        Employees::create([
          'code' => str_limit($faker->uuid, 5, ''),
          'firstnames' => $faker->firstName(),
          'lastnames' => $faker->lastName(),
          'nickname' => $faker->sentence(1),
          'identify_document' => str_limit($faker->uuid, 12, ''),
          'birthdate' => $faker->dateTimeBetween('-30 years', '-12 years'),
          'hiredate' => $faker->dateTimeBetween('-12 years', '-1 years'),
          'gender' => $gender[rand(0, 1)],
          'blood' => $blood[rand(0, sizeof($blood)-1)],
          'address' => $faker->address,
          'email' => $faker->email,
          'phonenumber' => $faker->phoneNumber(),
          'cellphone' => $faker->phoneNumber(),
          'position' => $faker->sentence(1),
          'imgpath' => null,
          'drive_license' => str_limit($faker->uuid, 12, ''),
          'drive_license_category' => $driveLicenseCategory[rand(0, sizeof($driveLicenseCategory)-1)],
          'drive_license_start' => $faker->dateTimeBetween('-6 years', '-4 years'),
          'drive_license_end' => $faker->dateTimeBetween('-2 years', '+3 years'),
          'drive_license_restriction' => 'Ninguna',
          'project_id' => Projects::inRandomOrder()->take(1)->pluck('id')->first(),
          'status' => $status[rand(0, sizeof($status)-1)],
          'country_id' => Countries::inRandomOrder()->take(1)->pluck('id')->first()
        ]);
      }
    }
}
