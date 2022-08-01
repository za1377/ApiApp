<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Validator;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }

        if(Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password])){
            $user = Auth::guard('admin')->user();
            $token = $user->createToken('Admin' , ['admin'])->plainTextToken;
            return response()->json(['token' => $token], 200);
        }
    }
}
