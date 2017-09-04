<?php

use Illuminate\Database\Seeder;
use App\Countries;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $countriesList = \Storage::drive('local')->get('json/country.json');
      $countries = json_decode($countriesList);

      foreach ($countries as $country) {
        Countries::create([
          'code' => $country->Code,
          'name' => $country->Name
        ]);
      }
    }
}
