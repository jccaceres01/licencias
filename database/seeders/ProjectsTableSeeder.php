<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Projects;
use App\Models\Countries;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $country = Countries::where('code', 'DO')->first();
      $projects = [
        [
          'name' => 'PVDC TSF',
          'address' => $faker->address,
          'country_id' => $country->id,
          'description' => $faker->sentence(rand(2, 5)),
          'email' => 'info@socococr.com',
          'latitude' => $faker->latitude,
          'longitude' => $faker->longitude,
          'altitude' => $faker->numberBetween(10, 20, 2)
        ],
        [
          'name' => 'PVDC Mina',
          'address' => $faker->address,
          'country_id' => $country->id,
          'description' => $faker->sentence(rand(2, 5)),
          'email' => 'info@socococr.com',
          'latitude' => $faker->latitude,
          'longitude' => $faker->longitude,
          'altitude' => $faker->numberBetween(10, 20, 2)
        ],
        [
          'name' => 'CMD',
          'address' => $faker->address,
          'country_id' => $country->id,
          'description' => $faker->sentence(rand(2, 5)),
          'email' => 'info@socococr.com',
          'latitude' => $faker->latitude,
          'longitude' => $faker->longitude,
          'altitude' => $faker->numberBetween(10, 20, 2)
        ],
        [
          'name' => 'TCB',
          'address' => $faker->address,
          'country_id' => $country->id,
          'description' => $faker->sentence(rand(2, 5)),
          'email' => 'info@socococr.com',
          'latitude' => $faker->latitude,
          'longitude' => $faker->longitude,
          'altitude' => $faker->numberBetween(10, 20, 2)
        ]
      ];

      foreach ($projects as $project){
        Projects::create($project);
      }
    }
}
