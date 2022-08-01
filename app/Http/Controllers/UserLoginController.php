<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }

        if(Auth::guard('user')->attempt(['email' => $request->email , 'password' => $request->password])){
            $user = Auth::guard('user')->user();
            $token = $user->createToken('user' , ['user'])->plainTextToken;
            return response()->json(['token' => $token], 200);
        }
    }
}
