<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
  protected $table = 'groups';
  protected $fillable = ['name', 'employee_id', 'project_id'];

  /**
   * Get supervisor (employee_id)
   */
  public function supervisor() {
    return $this->hasOne('App\Employees', 'id', 'employee_id');
  }

  /**
   * Get employees in a group
   */
  public function employees() {
    return $this->hasMany('App\Employees', 'id', 'employee_id');
  }

  /**
   * Get project of the turn
   */
  public function project() {
    return $this->hasOne('App\Projects', 'id', 'project_id');
  }

  /**
   * Search query scope
   */
  public function scopeSearch($query, $criteria) {
    if ($criteria != null) {
      return $query->where('name', 'like', '%'. $criteria .'%')
        ->orWhereHas('supervisor', function($callback) use ($criteria) {
          return $callback->where('firstnames', 'like', '%'.$criteria.'%')
            ->orWhere('lastnames', 'like', '%'.$criteria.'%');
        })->orWhereHas('project', function($callback) use ($criteria) {
          return $callback->where('name', 'like', '%'.$criteria.'%');
        });
    }
  }
}
