<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

  protected $fillable = ['name', 'description', 'level'];

  protected $hidden = ['remember_token'];

  public function items()
  {
    return $this->hasMany('App\Item');
  }
}
