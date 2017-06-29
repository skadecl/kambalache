<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemOffer;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Offer;

use DB;

// use App\Http\Requests;
// use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user_id = JWTAuth::getPayload($request->token)->get('sub');
      return Offer::where('offeror_id', $user_id)->get()->load('owner_item', 'items_offer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $offer_data = $request->all();
       $offer_data['offeror_id'] = JWTAuth::getPayload($request->token)->get('sub');
       $offer = Offer::create($offer_data);
       foreach ($request->items as $key => $itemoffer) {
         $this_offer = New ItemOffer;
         $this_offer->item_id = $itemoffer;
         $this_offer->offer_id = $offer->id;
         $this_offer->save();
       }
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
        return Offer::find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function items($id)
    {
      return DB::table('items')
        ->join('items_offers', 'items.id', '=', 'items_offers.item_id')
        ->where('items_offers.offer_id', $id)
        ->get();
    }
}
