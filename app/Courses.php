<?php

namespace App;

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
    return $this->belongsToMany('App\Employees', 'employees_courses',
      'employee_id', 'course_id')
      ->withPivot(['start_date', 'end_date'])
      ->withTimestamps();
  }
}
