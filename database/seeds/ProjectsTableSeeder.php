<?php

use Illuminate\Database\Seeder;
use App\Projects;
use App\Countries;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $country = Countries::where('code', 'DO')->first();
      $projects = [
        [
          'name' => 'PVDC TSF',
          'address' => '',
          'country_id' => $country->id,
          'description' => '',
          'email' => 'info@socococr.com',
          'latitude' => null,
          'longitude' => null,
          'altitude' => null
        ],
        [
          'name' => 'PVDC Mina',
          'address' => '',
          'country_id' => $country->id,
          'description' => '',
          'email' => 'info@socococr.com',
          'latitude' => null,
          'longitude' => null,
          'altitude' => null
        ],
        [
          'name' => 'CMD',
          'address' => '',
          'country_id' => $country->id,
          'description' => '',
          'email' => 'info@socococr.com',
          'latitude' => null,
          'longitude' => null,
          'altitude' => null
        ]
      ];

      foreach ($projects as $project){
        Projects::create($project);
      }
    }
}
