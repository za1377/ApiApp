<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class SanctumController extends Controller {
    /**
     * @OA\Post(
     * path="/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="feest.delphine@example.net"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * ),
     * @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="token",
     *                     type="string"
     *                  )
     *
     *         )
     *     )
     */
    // public function logIn(Request $request){

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required',
    //     ]);

    //     $validated = $validator->validated();

    //     $user = Admin::where('email', $request->email )->first();

    //     if($user && Hash::check($validated['password'], $user->password)){
    //         return response()->json([
    //             "token" =>$user->createToken('token')->plainTextToken
    //         ], 200);
    //     }
    // }

    /**
     * @OA\Get(
     * path="/home",
     * summary="home",
     * description="Lsdsdsdsd",
     * operationId="sdsdsd",
     * tags={"home"},
     * @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *                  )
     *         )
     *     )
     * )
     */
    // public function home()
    // {
    //     try {
    //         return response()->json(["message" => "Karim"], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(["message" => $e->getMessage()], 200);
    //     }
    // }

}
