<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Courses;
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();

      for ($i=0; $i<3; $i++) {
        Courses::create([
          'name' => $faker->sentence(rand(1, 3)),
          'code' => str_random(rand(1,5))
        ]);
      }
    }
}
