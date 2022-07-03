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
     * path="/Attributes",
     * summary="Show all of Attribute",
     * description="display all of Attribute",
     * tags={"Attributes"},

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
     * path="/Attribute",
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
            $old_Attribute = Attributes::where($matchThese)->get();
            if($old_Attribute->count() > 0){
                return response()->json(['message' , 'These data can not be insert.'],409);
            }else{
                $Attribute = Attributes::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
                return response()->json($Attribute, 200);
            }

        }

    }

    /**
     * update the specefic data of Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     * path="/Attribute",
     * summary="update the name of the Attributes that use in categories",
     * description="update name and slug by admin",
     * tags={"Attributes"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass Attributes name and slug",
     *    @OA\JsonContent(
     *       required={"id","name","slug"},
     *       @OA\Property(property="id", type="string", format="id", example="1"),
     *       @OA\Property(property="name", type="string", format="name", example="sumsung"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/sumsung"),
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
     * @OA\Response(
     *         response=214,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="boolean"
     *                  ),
     *         )
     *     ),
     *
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

        $result = Attributes::where('slug' , $request->slug)->get();
        if($result->count() > 0){
            return response()->json(['message' , 'These data can not be insert.'],409);
        }

        $query = Attributes::find($id);

        if(! is_null($query)){

            if($data == []){
                return response()->json(['message' , 'nothing for update.'],422);
            }else{
                $Attribute = $query->update($data);
                return response()->json($Attribute, 200);
            }

        }else{
            return response()->json(['message' => 'Sorry, your data not found.'] , 404);
        }
    }

    /**
     * delete the specefic data of Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     * path="/Attribute",
     * summary="delete the row of the Attributes that is determined",
     * description="update name and slug by admin",
     * tags={"Attributes"},
     * @OA\RequestBody(
     *    required=true,
     *    description="delete Attributes name and slug",
     *    @OA\JsonContent(
     *       required={"id"},
     *       @OA\Property(property="id", type="string", format="id", example="1"),
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
     */
    public function delete(Request  $request){
        $id = intval($request->id);
        $Attribute = Attributes::where('id' , $id);
        if($Attribute->count() > 0){
            $Attribute->delete();
            return response()->json(["message" => "delete"], 200);
        }else{
            return response()->json(["message" => "not found"], 404);
        }
    }
}
