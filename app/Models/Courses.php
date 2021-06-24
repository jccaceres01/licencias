<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
  protected $table = 'courses';
  protected $fillable = [
    'name',
    'code'
  ];

  /**
   * Get Employees by a courses
   */
  public function employees() {
    return $this->belongsToMany('App\Models\Employees', 'employees_courses',
      'employee_id', 'course_id')
      ->withPivot(['start_date', 'end_date'])
      ->withTimestamps();
  }
}
