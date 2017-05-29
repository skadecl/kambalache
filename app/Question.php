<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $table = 'questions';

  protected $fillable = ['item_id', 'user_id', 'question', 'answer', 'status'];


  public function item()
  {
    return $this->belongsTo('App\Item');
  }
}
