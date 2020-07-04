<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Exceptions;
use Throwable;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role == 2){
            $users = User::where('role','1')->get();
            return response()->json([
                "users" => $users
            ]);
        }else{
            return response()->json([
                "message" => "You don't have permissions to do this"
            ],400);
        }
    }

    public function getCurrentUser(){
        return Auth::user();
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
        $user = Auth::user();
        if($user->role==2){
            try{
                $register = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|string',
                    'role' => 'required|numeric',
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
                $user->role = $register['role'];
                $user->password = Hash::make($register['password']);
    
                if($user->save()){
                    return response()->json([
                        "message" => "User created successfully",
                        "user" => Arr::except($user,['password'])
                    ],200);
                }else{
                    return response() -> json([
                        "message" => "Error creating user."
                    ], 400);
                }
            }catch(Throwable $e){
                return response()->json([
                    "message" => "Please send valid fields."
                ],400);
            }
        }else{
            return response() -> json([
                "message" => "You don't have permissions to do this."
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = Auth::user();
        if($user->role==2 || ($id == $user->id)){
            try{
                $register = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|string',
                    'role' => 'required|string',
                    'password' => 'string|nullable',
                    'password2' => 'string|nullable'
                ]);
                
                if($register['password'] != $register['password2']){
                    return response()->json([
                        "message" => "Passwords don't match."
                    ],400);
                }
                
                $user = User::find($id);
    
                $user->name = $register['name'];
                $user->email = $register['email'];
                $user->role = $register['role'];
                if($register['password'])
                    $user->password = Hash::make($register['password']);
    
                if($user->save()){
                    return response()->json([
                        "message" => "User updated successfully",
                        "user" => Arr::except($user,['password'])
                    ],200);
                }else{
                    return response() -> json([
                        "message" => "Error updating user."
                    ], 400);
                }
            }catch(Throwable $e){
                return response()->json([
                    "message" => "Please send valid fields."
                ],400);
            }
        }else{
            return response() -> json([
                "message" => "You don't have permissions to do this."
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->role == 2 || ($id == $user->id)){
            if($user = User::find($id)){
                if($user->role!=2 || ($id == $user->id)){
                    $user->delete();
                    Cart::where('user_id',$id)->delete();
                    return response()->json([
                        "message" => "User deleted successfully."
                    ], 200);
                }else{
                    return response()->json([
                        "message" => "Error, this user can't be deleted by you."
                    ], 400);    
                }
            }else{
                return response()->json([
                    "message" => "User not found."
                ], 400);
            }
        }else{
            return response()->json([
                "message" => "Error, you can't do this."
            ], 400);
        }
    }
}
