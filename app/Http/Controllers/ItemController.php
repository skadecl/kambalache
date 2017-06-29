<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;
// use App\Http\Controllers\Controller;
use App\Item;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;
use App\Photo;
use App\Interest;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = JWTAuth::getPayload($request->token)->get('sub');
        return Item::where('user_id', $user_id)->get()->load('photos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $user_id = JWTAuth::getPayload($request->token)->get('sub');
      $new_item_data = $request->all();
      $new_item_data['user_id'] = $user_id;
      $item = Item::create($new_item_data);
      foreach ($request->photos as $key => $photo) {
        $base64_str = substr($photo, strpos($photo, ",")+1);
        $image = base64_decode($base64_str);
        $name = $item->id."-".$key.time().".jpg";
        Storage::put('public/items/'.$name, $image);
        $photo = new Photo;
        $photo->item_id = $item->id;
        $photo->content = $name;
        $photo->save();
        if ($key == 0) {
          $item->avatar = $name;
          $item->save();
        }
      }
      return ['created' => true, 'item' => $item->load('photos')];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Item::create($request->all());
      return ['created' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id)->load('photos', 'user');
        $item->views = $item->views + 1;
        $item->save();
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $item = Item::find($id);
      $item->update($request->all());
      return ['updated' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Item::destroy($id);
      return ['deleted' => true];
    }

    public function photos($id)
    {
      return Item::find($id)->photos;
    }

    public function offers($id)
    {
      $offers = Item::find($id)->offers;
      $offers->load('owner_item', 'items_offer');
      return $offers;
    }

    public function open_search(Request $request)
    {
      return Item::search($request->search)->get();
    }

    public function questions($id)
    {
      return Item::find($id)->questions;
    }

    public function interested(Request $request, $id)
    {
      $user_id = JWTAuth::getPayload($request->token)->get('sub');

      $item = Item::find($id);
      $item->interested = $item->interested + 1;

      $interest = new Interest;
      $interest->user_id = $user_id;
      $interest->item_id = $item->id;

      $item->save();
      $interest->save();

      return ['created' => true];
    }

}
