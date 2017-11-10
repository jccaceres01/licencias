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

        $employee->equipmentTypes()->attach($equipmentTypes);
      }
    }
}
