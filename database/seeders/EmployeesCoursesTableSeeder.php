<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employees;
use App\Models\Courses;
use Faker\Factory as Faker;

class EmployeesCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();

      foreach (Employees::all() as $employee) {
        $courses = Courses::inRandomOrder()->take(rand(0, Courses::count()))
          ->pluck('id')->toArray();

        foreach ($courses as $course) {
          $employee->courses()->attach($course, [
            'date' => $faker->dateTimeBetween('-30 days', '-3 days'),
            'filepath' => null,
            'carnet_print' => rand(0, 1)
          ]);
        }
      }
    }
}
