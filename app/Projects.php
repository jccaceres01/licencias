<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
  protected $table = 'projects';
  protected $fillable = [
    'name',
    'address',
    'country_id',
    'description',
    'email',
    'latitude',
    'longitude',
    'altitude'
  ];
}
