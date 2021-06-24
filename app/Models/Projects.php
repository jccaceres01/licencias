<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
  protected $table = 'projects';
  protected $fillable = [
    'name',
    'address',
    'country_id',
    'description',
    'employee_id',
    'email',
    'latitude',
    'longitude',
    'altitude'
  ];

  /**
   * Get country of a project
   */
  public function country() {
    return $this->hasOne('App\Models\Countries', 'id', 'country_id');
  }

  /**
   * Get projects' groups
   */
  public function groups() {
    return $this->hasMany('App\Models\Groups', 'project_id', 'id');
  }

  /**
   * Search projects query scope
   */
  public function scopeSearch($query, $criteria) {
    if ($criteria != null) {
      return $query->where('name', 'like', '%'.$criteria.'%')
        ->orWhereHas('country', function($callback) use ($criteria) {
          return $callback->where('name', 'like', '%'.$criteria.'%');
        });
    }
  }

  /**
   * Get General supervisor
   */
  public function generalSupervisor() {
    return $this->hasOne('App\Models\Employees', 'id', 'employee_id');
  }
}
