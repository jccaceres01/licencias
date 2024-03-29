<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  /**
   * users search query scope
   */
  public function scopeSearch($query, $criteria) {
    if ($criteria != null) {
      return $query->where('name', 'like', '%'.$criteria.'%')
        ->orWhere('email', 'like', '%'.$criteria.'%');
    }
  }
}
