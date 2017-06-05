<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;
// use App\Http\Controllers\Controller;
use App\User;
use App\Interest;
use DB;


class UserController extends Controller
{

    // INDEX
    public function index()
    {
        return User::all();
    }

    //CREATE
    public function create()
    {
      User::create($request->all());
      return ['created' => true];
    }

    //STORE
    public function store(Request $request)
    {
      User::create($request->all());
      return ['created' => true];
    }


    //SHOW
    public function show($id)
    {
        return User::find($id);
    }

    //EDIT
    public function edit($id)
    {
        //
    }

    //UPDATE
    public function update(Request $request, $id)
    {
      $user = User::find($id);
      $user->update($request->all());
      return ['updated' => true];
    }

    //DESTROY
    public function destroy($id)
    {
      User::destroy($id);
      return ['deleted' => true];
    }

    //GET ITEMS
    public function items($id)
    {
      return User::find($id)->items;
    }

    //GET INTERESTS
    public function interests($id)
    {
      return DB::table('interests')
                ->join('items', 'interests.item_id', '=', 'items.id')
                ->where('interests.user_id', $id)
                ->get();
    }
}
