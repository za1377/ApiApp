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
     * path="/Show/Attributes/Types",
     * summary="Show all of AttributesType",
     * description="display all of AttributesType",
     * tags={"AttributesType"},

     * @OA\Response(
     *    response=404,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not found.")
     *        )
     *     )
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
     * path="/New/Attributes/Types",
     * summary="insert the name of the AttributesType that use in categories",
     * description="insert name and slug by admin",
     * tags={"AttributesType"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass AttributesType name and slug",
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
            $old_attr_type = AttributesTypes::where($matchThese)->get();
            if($old_attr_type->count() > 0){
                return response()->json(['message' , 'These data can not be insert.'],409);
            }else{
                $attr_type = AttributesTypes::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
                return response()->json($attr_type, 200);
            }

        }

    }

    /**
     * update the specefic data of AttributesType's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     *   path="/Update/Attributes/Types",
     *   summary="update the name of the AttributesType that use in categories",
     *   description="update name and slug by admin",
     *   tags={"AttributesType"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="Pass AttributesType name and slug",
     *     @OA\JsonContent(
     *       required={"id","name","slug"},
     *       @OA\Property(property="id", type="string", format="id", example="1"),
     *       @OA\Property(property="name", type="string", format="name", example="sumsung"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/sumsung"),
     *    ),
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Wrong credentials response",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not found.")
     *     )
     *   )
     * )
     */
    public function update(Request  $request){
        $id = intval($request->id);
        $data = array();

        if($request->name != ""){
            $data += ['name' => $request->name];
        }
        if($request->slug != ""){
            $data += ['slug' => $request->slug];
        }

        $result = AttributesTypes::where('slug' , $request->slug)->get();
        if($result->count() > 0){
            return response()->json(['message' , 'These data can not be insert.'],409);
        }

        $query = AttributesTypes::find($id);

        if(! is_null($query)){

            if($data == []){
                return response()->json(['message' , 'nothing for update.'],422);
            }else{
                $atrr_type = $query->update($data);
                return response()->json($atrr_type, 200);
            }

        }else{
            return response()->json(['message' => 'Sorry, your data not found.'] , 404);
        }
    }
}
