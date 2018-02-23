<?php

use Illuminate\Database\Seeder;
use App\Employees;
use App\EquipmentTypes;

class EmployeesEquipmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach(Employees::all() as $employee) {
        $equipmentTypes = EquipmentTypes::inRandomOrder()
          ->take(rand(1, EquipmentTypes::count()))->pluck('id')->toArray();

        foreach ($equipmentTypes as $equipmentType) {
          $date = new \DateTime(rand(-30, 30).' days');

          $employee->equipmentTypes()->attach($equipmentType, [
            'date' => $date->format('Y-m-d'),
            'filepath' => null,
            'carnet_print' => rand(0, 1)
          ]);
        }
      }
    }
}
