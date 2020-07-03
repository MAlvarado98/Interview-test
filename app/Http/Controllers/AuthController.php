<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions;
use Throwable;
use Exception;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        try{
            $login = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);
            if(!Auth::attempt($login)){
                return response() -> json([
                    "message" => "Error, Invalid credentials."
                ], 400);
            }
    
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
    
            return response()->json([
                "token" => $accessToken,
                "user" => Auth::user()
            ],200);

        }catch(Throwable $e){
            return response()->json([
                "message" => "Please send valid fields."
            ]);
        }
    }

    public function register(Request $request){
        try{
            $register = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
                'password2' => 'required|string'
            ]);
            
            if($register['password'] != $register['password2']){
                return response()->json([
                    "message" => "Passwords don't match."
                ]);
            }
            
            $user = new User();

            $user->name = $register['name'];
            $user->email = $register['email'];
            $user->role = 1;
            $user->password = Hash::make($register['password']);

            if($user->save()){
                $login = Arr::except($register,['name','password2']);
                if(!Auth::attempt($login)){
                    return response() -> json([
                        "message" => "Something went wrong."
                    ], 400);
                }
                $accessToken = Auth::user()->createToken('authToken')->accessToken;
                return response()->json([
                    "token" => $accessToken,
                    "user" => Auth::user()
                ],200);
            }else{
                return response() -> json([
                    "message" => "Error creating user."
                ], 400);
            }
        }catch(Throwable $e){
            return response()->json([
                "message" => "Please send valid fields."
            ]);
        }
    }
}
