<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            "email" => 'required',
            "password" => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => "the provided credentials are incorrect",
            ]);
        };
        if(Hash::check($request->password,$user->password)){
            $token = $user->createToken($request->email)->plainTextToken;
            return ['status'=>true,'token'=>$token,'user'=>$user];
        }else{
            return ['status'=>false];
        }
    }
}
