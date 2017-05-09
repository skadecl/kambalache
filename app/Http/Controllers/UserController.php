<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;
// use App\Http\Controllers\Controller;
use App\User;

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
}
