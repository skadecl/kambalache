<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = 'items';

  protected $fillable = ['user_id', 'category_id', 'name', 'description'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function photos()
  {
    return $this->hasMany('App\Photo');
  }

  public function offers()
  {
    return $this->hasMany('App\Offer', 'owner_item_id');
  }
}
