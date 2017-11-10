<?php

use Illuminate\Database\Seeder;
use App\EquipmentTypes;

class EquipmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $equipmentTypes = [
        [
          'name' => 'Camioneta Pickup',
          'code' => 'CAMPI'
        ],
        [
          'name' => 'Retro Excavadora',
          'code' => 'RETRO'
        ]
      ];

      foreach ($equipmentTypes as $et) {
        EquipmentTypes::create($et);
      }
    }
}
