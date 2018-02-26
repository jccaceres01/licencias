<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
  protected $table = 'employees';

  protected $fillable = [
    'code',
    'firstnames',
    'lastnames',
    'nickname',
    'identity_document',
    'birthdate',
    'hiredate',
    'gender',
    'blood',
    'address',
    'email',
    'phonenumber',
    'cellphone',
    'position',
    'imgpath',
    'drive_license',
    'drive_license_category',
    'drive_license_start',
    'drive_license_end',
    'drive_license_restriction',
    'project_id',
    'status',
    'employee_type',
    'group_id',
    'country_id'
  ];

  public static $gender = ['M', 'F'];
  public static $blood = [
    'O+',
    'O-',
    'A+',
    'A-',
    'B+',
    'B-',
    'AB+',
    'AB-'
  ];
  public static $driveLicenseCategory = [
    '01 Conductor',
    '02 Conductor',
    '03 Primera  Pesados',
    '04 Segunda  Pesados',
    '05 Especial'
  ];

  public static $employeeType = [
    'administrativo',
    'supervisor de turno',
    'supervisor',
    'mecanico',
    'operador'
  ];

  public static $status = ['activo', 'cacelado', 'parado'];

  /**
   * Project foreign key
   */
  public function project() {
    return $this->hasOne('App\Projects', 'id', 'project_id');
  }

  /**
   * Shift foreign key
   */
  public function group() {
    return $this->hasOne('App\Groups', 'id', 'group_id');
  }

  /**
   * Nationality, countries foreign key
   */
  public function country() {
    return $this->hasOne('App\Countries', 'id', 'country_id');
  }

  /**
   * Search query scope
   */
  public function scopeSearch($query, $criteria) {
    if ($criteria != null) {
      return $query->where('code', 'like', '%'.$criteria.'%')
        ->orWhere('firstnames', 'like', '%'.$criteria.'%')
        ->orWhere('lastnames', 'like', '%'.$criteria.'%')
        ->orWhere('identity_document', 'like', '%'.$criteria.'%');
    }
  }

  /**
   * Actives and stop employees scope
   */
  public function scopeActive($query) {
    return $query->where('status', 'activo');
  }

  /**
   * parado employees scope
   */
  public function scopeStandby($query) {
    return $query->where('status', 'parado');
  }

  /**
   * Actives and standBy employees
   */
  public function scopeActiveAndStandBy($query) {
    return $query->where('status', 'activo')->orWhere('status', 'parado');
  }

  /**
   * Cancelado employees query scope
   */
  public function scopeDown($query) {
    return $query->where('status', 'cancelado');
  }

  /**
   * Latam birthdate mutator
   */
  public function getLatamBirthdateAttribute() {
    if ($this->attributes['birthdate'] != null) {
      $birthdate = new \DateTime($this->attributes['birthdate']);
      return $birthdate->format('d-m-Y');
    } else {
      return null;
    }
  }

  /**
   * Latam hiredate mutator
   */
  public function getLatamHiredateAttribute() {

    if ($this->attributes['hiredate'] != null) {
      $hiredate = new \DateTime($this->attributes['hiredate']);
      return $hiredate->format('d-m-Y');
    } else {
      return null;
    }
  }

  /**
   * Latam drive license start mutator
   */
  public function getLatamDriveLicenseStartAttribute() {

    if ($this->attributes['drive_license_start'] != null) {
      $date = new \DateTime($this->attributes['drive_license_start']);
      return $date->format('d-m-Y');
    } else {
      return null;
    }
  }

  /**
   * Latam drive license end mutator
   */
  public function getLatamDriveLicenseEndAttribute() {
    if ($this->attributes['drive_license_end'] != null) {
      $date = new \DateTime($this->attributes['drive_license_end']);
      return $date->format('d-m-Y');
    } else {
      return null;
    }
  }

  /**
   * Get equipments that this employees can operate and hander
   */
  public function equipmentTypes() {
    return $this->belongsToMany(
      'App\EquipmentTypes',
      'employees_equipment_types',
      'employee_id',
      'equipment_type_id'
    )->withPivot(['date', 'filepath', 'carnet_print'])->withTimestamps();
  }

  /**
   * Get contacts of employees relationship
   */
  public function contacts() {
    return $this->hasMany('App\Contacts', 'employee_id', 'id');
  }

  /**
   * Get Courses by a employee
   */
  public function courses() {
    return $this->belongsToMany('App\Courses', 'employees_courses',
      'employee_id', 'course_id')
        ->withPivot(['date', 'filepath', 'carnet_print'])
        ->withTimestamps();
  }

  /**
   * Get full name of a employee
   */
  public function getFullNameAttribute() {
    return $this->attributes['firstnames'].' '.$this->attributes['lastnames'];
  }
}
