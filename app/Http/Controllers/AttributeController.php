<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AttributeController extends Controller
{
    /**
     * display data of Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="/Show/Attributes",
     * summary="Show all of Attribute",
     * description="display all of Attribute",
     * tags={"Attribute"},

     * @OA\Response(
     *    response=404,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not found.")
     *        )
     *     )
     * ),
     *
     * @OA\Response(
     *         response=212,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *                  ),
     *         )
     *     )
     *
     */
    public function show(){
        $Attributes = Attributes::all();

        if($Attributes->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }else{
            return response()->json($Attributes, 200);
        }
    }
}
