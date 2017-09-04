<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentTypes extends Model
{
  protected $table = 'equipment_types';
  protected $fillable = [
    'name',
    'short_name',
    'classification',
    'imgpath',
    'description'
  ];

  public static $classification = [
    'equipo',
    'herramienta'
  ];

  /**
   * Return employees in an equipment type
   */
  public function employees() {
    return $this->belongsToMany(
      'App\EquipmentTypes',
      'employees_equipment_types',
      'employee_id',
      'equipment_type_id'
    )->withTimestamps();
  }
}
