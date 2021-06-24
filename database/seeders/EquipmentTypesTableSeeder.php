<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentTypes;

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
