<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Hash;

class AuthController extends Controller
{

  use AuthenticatesAndRegistersUsers;

  public function sign_in(Request $request)
  {
    $credentials = $request->only('email', 'password');

      try {
          // verify the credentials and create a token for the user
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong
          return response()->json(['error' => 'could_not_create_token'], 500);
      }
      // if no errors are encountered we can return a JWT
      return response()->json(compact('token'));
    }

    public function sign_up(Request $request)
    {
      $data = $request->all();
      $data['password'] = Hash::make($data['password']);
      User::create($data);
      return ['created' => true];
    }
}
