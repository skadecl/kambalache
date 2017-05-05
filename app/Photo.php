<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Photo extends Model
{
  protected $table = 'photos';

  protected $fillable = ['item_id', 'content'];

  public function item()
  {
    return $this->belongsTo('App\Item');
  }
}
