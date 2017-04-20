<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';

  protected $fillable = ['first_name', 'last_name', 'email', 'password'];

  protected $hidden = ['password', 'remember_token'];

  public function items()
  {
    return $this->hasMany('App\Item');
  }
}
