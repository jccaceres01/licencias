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
          'short_name' => 'CAMPI',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/pickup.png',
          'description' => null
        ],
        [
          'name' => 'Retro Excavadora',
          'short_name' => 'RETRO',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/retro_excavadora.png',
          'description' => null
        ],
        [
          'name' => 'Pala Frontal',
          'short_name' => 'PALAF',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/pala_frontal.png',
          'description' => null
        ],
        [
          'name' => 'Tractor',
          'short_name' => 'TRACT',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/tractor.png',
          'description' => null
        ],
        [
          'name' => 'Motoniveladora',
          'short_name' => 'MOTON',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/motoniveladora.png',
          'description' => null
        ],
        [
          'name' => 'Camion Rigido 773',
          'short_name' => 'CA773',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/773.png',
          'description' => null
        ],
        [
          'name' => 'Camion Articulado 740',
          'short_name' => 'CA740',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/740.png',
          'description' => null
        ],
        [
          'name' => 'Compactador',
          'short_name' => 'COMPA',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/compactador.png',
          'description' => null
        ],
        [
          'name' => 'Tractor de Llantas',
          'short_name' => 'TRALL',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/tractor_llantas.png',
          'description' => null
        ],
        [
          'name' => 'Camion Combustible',
          'short_name' => 'CAMCO',
          'classification' => 'equipo',
          'imgpath' => 'img/page/equipmenttypes/camion_combustible.png',
          'description' => null
        ],
      ];

      foreach ($equipmentTypes as $et) {
        EquipmentTypes::create($et);
      }
    }
}
