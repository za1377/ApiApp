<?php

namespace App\Http\Controllers;

use App\Models\AttributesTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AttributeTypeController extends Controller
{
    /**
     * display data of AttributesType's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Attribute/Types",
     *      summary="Show all of AttributesType",
     *      description="display all of AttributesType",
     *      tags={"AttributesType"},
     *      @OA\Response(
     *          response=404,
     *          description="Not_Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *             ),
     *         )
     *      )
     * ),
     *
     *
     */
    public function show(){
        $attr_type = AttributesTypes::all();

        if($attr_type->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }else{
            return response()->json($attr_type, 200);
        }
    }

    /**
     * insert data to AttributesType's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Attribute/Type",
     *      summary="insert the name of the AttributesType that use in categories",
     *      description="insert name and slug by admin",
     *      tags={"AttributesType"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributesType name and slug",
     *          @OA\JsonContent(
     *              required={"name","slug"},
     *              @OA\Property(property="name", type="string", format="name", example="sony"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/sony"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *         description="Bad Request",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="object_created",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *      ),
     * ),
     *
     *
     */
    public function insert(Request  $request){

        $validated = $request->validated();

        $matchThese = ['slug' => $request->slug];
        $old_attr_type = AttributesTypes::where($matchThese)->get();
        if($old_attr_type->count() > 0){
            return response()->json(['message' , 'These data can not be insert.'],400);
        }else{
            $attr_type = AttributesTypes::create([
                "name" => $request->name,
                "slug" => $request->slug]);
            return response()->json($attr_type, 201);
        }
    }
}
