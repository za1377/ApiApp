<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    /**
     * @OA\Post(
     *      path="/login/user",
     *      summary="Sign in",
     *      description="Login by email, password",
     *      operationId="authLoginUser",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", format="email", example="feest.delphine@example.net"),
     *              @OA\Property(property="password", type="string", format="password", example="password"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *          )
     *      ),
     *      @OA\Response(
     *              response=200,
     *              description="OK",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                          property="token",
     *                          type="string"
     *                  )
     *              )
     *      )
     * ),
     *
     */
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
