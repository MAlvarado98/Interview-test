<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
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
    }
}