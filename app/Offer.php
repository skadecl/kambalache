<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  protected $table = 'offers';

  protected $fillable = ['offeror_id', 'owner_item_id', 'comment', 'status'];

  public function offeror()
  {
    return $this->hasOne('App\User', 'offeror_id');
  }

  public function owner_item()
  {
    return $this->belongsTo('App\Item', 'owner_item_id');
  }

  public function items_offer()
  {
    return $this->hasMany('App\ItemOffer');
  }
}
