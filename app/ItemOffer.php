<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOffer extends Model
{
  protected $table = 'items_offers';

  protected $fillable = ['item_id', 'offer_id'];

  public function item(){
    return $this->belongsTo('App\Item');
  }

}
