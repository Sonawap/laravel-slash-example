<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(CreateUserRequest $request){
        $user = new User();
        $user->name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $token =  $user->createToken($user->email .'Access Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);

    }

    public function validateEmail(Request $request){
        $check = User::where('email', $request->email)->exists();
        if($check){
            return response()->json([
                'message' => "Email Already Exists"
            ],403);
        }else{
            return response()->json([
                'message' => "Email is Avaliable"  
            ],200);
        }
    }

    public function user(){
        $user = auth()->user();
        return response->json([
            'user' => $user,
        ], 200);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return response->json([
            'user' => $user
        ], 200);
    }


    public function login(LoginRequest $request){
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();
            $token =  $user->createToken($user->email .'Access Token')->plainTextToken;
            return response->json([
                'user' => $user,
                'token' => $token
            ], 200);
        }
        else{
            return response->json([
                'message' => 'Login Failed',
            ], 308);
        }
    }


    public function logout(){
        auth()->user()->tokens()->delete();
        return response->json([
            "Logged Out"
        ],200);
    }
}
