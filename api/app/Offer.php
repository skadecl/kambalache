<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  protected $table = 'offers';

  protected $fillable = ['offeror_item_id', 'owner_item_id', 'comment'];

  public function offeror_item()
  {
    return $this->belongsTo('App\Item', 'offeror_item_id');
  }

  public function owner_item()
  {
    return $this->belongsTo('App\Item', 'owner_item_id');
  }
}
