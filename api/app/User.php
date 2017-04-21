<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
  use Authenticatable;

  protected $table = 'users';

  protected $fillable = ['first_name', 'last_name', 'email', 'password'];

  protected $hidden = ['password', 'remember_token'];

  public function items()
  {
    return $this->hasMany('App\Item');
  }
}
