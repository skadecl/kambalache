<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
  protected $table = 'interests';

  protected $fillable = ['user_id', 'item_id'];

  public function interestable()
  {
    return $this->morphTo();
  }

  public function item()
  {
    return $this->belongsTo('App\Item');
  }

}
