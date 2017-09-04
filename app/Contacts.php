<?php

namespace App;

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
    'conyugue',
    'padre',
    'madre',
    'otros familiares',
    'amig@',
    'conocid@'
  ];

  /**
   * Contacts belongsTo employee relationship
   */
  public function employee() {
    return $this->belongsTo('App\Employees', 'employee_id', 'id');
  }
}
