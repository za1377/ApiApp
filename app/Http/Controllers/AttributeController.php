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

    /**
     * insert data to Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     * path="/New/Attributes",
     * summary="insert the name of the Attributes that use in categories",
     * description="insert name and slug by admin",
     * tags={"Attributes"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass Attributes name and slug",
     *    @OA\JsonContent(
     *       required={"name","slug"},
     *       @OA\Property(property="name", type="string", format="name", example="sony"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/sony"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, your data not supported.")
     *        )
     *     )
     * ),
     *
     * @OA\Response(
     *         response=213,
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
    public function insert(Request  $request){
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' , 'Sorry, your data not supported'],422);
        }else{
            $matchThese = ['slug' => $request->slug];
            $old_brand = Attributes::where($matchThese)->get();
            if($old_brand->count() > 0){
                return response()->json(['message' , 'These data can not be insert.'],409);
            }else{
                $brand = Attributes::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
                return response()->json($brand, 200);
            }

        }

    }
}
