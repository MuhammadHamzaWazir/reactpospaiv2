<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'name.*' => 'required|string|distinct|min:3',
            'email.*' => 'required|email|unique:users',
            'password.*' => 'required|confirmed',
        ]);
        if ($validator->fails())
            {
                return response(['errors'=>$validator->errors()->all()], 422);
            }
        $request['password'] = bcrypt($request->password);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->all());

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
    ]);
    if ($validator->fails())
    {
        return response(['errors'=>$validator->errors()->all()], 422);
    }
    if (auth()->attempt($request->all())) 
        {
                $token = auth()->user()->createToken('API Token')->accessToken;
                $response = ['user' => auth()->user(), 'token' => $token];
                return response($response, 200);
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }

    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}