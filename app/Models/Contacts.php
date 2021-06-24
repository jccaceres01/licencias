<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
  protected $table = 'contacts';
  protected $fillable = [
    'firstnames',
    'lastnames',
    'email',
    'phone',
    'cell',
    'address',
    'relation',
    'employee_id'
  ];

  public static $relation = [
    'conyuge',
    'padre',
    'madre',
    'otros familiares',
    'amig@',
    'conocid@'
  ];

  /**
   * Get full name  attribute
   */
  public function getFullNameAttribute() {
    return $this->attributes['firstnames'].$this->attributes['lastnames'];
  }

  /**
   * Contacts belongsTo employee relationship
   */
  public function employee() {
    return $this->belongsTo('App\Models\Employees', 'employee_id', 'id');
  }
}
