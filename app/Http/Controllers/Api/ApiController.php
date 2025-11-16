<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApiController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|Unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $user = User::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $user
        ],201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'error' => true,
                'message' => 'You are not Othorized User'
            ],401);
        }else{
            if(Hash::check($request->password, $user->password)){
                $token = $user->CreateToken('api')->plainTextToken;
                return response()->json([
                    'success' => true,
                    // 'message' => 'Congratulations You are login'
                    'data' => $user,
                    'token' => $token
                ]);
            }else{
                return response()->json([
                'error' => true,
                'message' => 'You are not Othorized User'
            ],401);
            }
        }
    }
    public function logout(Request $request){
        // auth()->user()->currentAccessToken()->delete();
        auth()->user()->Tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'logout Sucessfully'
        ]);
    }
}
