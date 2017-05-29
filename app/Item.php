<?php
namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  use Searchable;

  protected $table = 'items';

  protected $fillable = ['user_id', 'category_id', 'name', 'description', 'new', 'use_time', 'use_type', 'settings_new', 'settings_use_time', 'settings_use_type', 'views', 'interested', 'status', 'avatar'];

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

  public function searchableAs()
  {
    return 'items_index';
  }

  public function questions()
  {
    return $this->hasMany('App\Question');
  }
}
