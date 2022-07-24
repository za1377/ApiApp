<?php

namespace App\Http\Controllers;

use App\Models\AttributesValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AttributeValueRequest;
use App\Http\Resources\AttributeValueResource;

class AttributeValueController extends Controller
{
    /**
     * display data of AttributesValue's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Attribute/Values",
     *      summary="Show all of AttributesValue",
     *      description="display all of AttributesValues",
     *      tags={"AttributesValues"},
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
        $attr_val = AttributesValues::all();

        if($attr_val->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }else{
            return AttributeValueResource::collection(AttributesValues::all());
        }
    }

    /**
     * insert data to AttributesValue's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Attribute/Value",
     *      summary="insert the name of the AttributesValue that use in categories",
     *      description="insert name and slug by admin",
     *      tags={"AttributesValues"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributesValue name and slug",
     *          @OA\JsonContent(
     *              required={"name","slug"},
     *              @OA\Property(property="name", type="string", format="name", example="radiobutton"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/radiobutton"),
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
    public function insert(AttributeValueRequest  $request){
        $attr_val = AttributesValues::create([
            "name" => $request->name,
            "slug" => $request->slug]);
        return new AttributeValueResource($attr_val);

    }

    /**
     * update the specefic data of AttributesValue's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Attribute/Value",
     *      summary="update the name of the AttributesValues that use in categories",
     *      description="update name and slug by admin",
     *      tags={"AttributesValues"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and slug",
     *          @OA\JsonContent(
     *              required={"id","name","slug"},
     *              @OA\Property(property="id", type="string", format="id", example="1"),
     *              @OA\Property(property="name", type="string", format="name", example="checkbox"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/checkbox"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="bad request",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not_Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *      ),
     *
     *      @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="boolean"
     *             ),
     *         )
     *      ),
     * ),
     *
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

        $result = AttributesValues::where('slug' , $request->slug)->get();
        if($result->count() > 0){
            return response()->json(['message' , 'These data can not be insert.'],400);
        }

        $query = AttributesValues::find($id);

        if(! is_null($query)){

            if($data == []){
                return response()->json(['message' , 'nothing for update.'],400);
            }else{
                $attr_val = $query->update($data);
                return new AttributeValueResource(AttributesValues::find($id));
            }

        }else{
            return response()->json(['message' => 'Sorry, your data not found.'] , 404);
        }
    }

    /**
     * delete the specefic data of brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Attribute/Value",
     *      summary="delete the row of the AttributesValues that is determined",
     *      description="delete name and slug by admin",
     *      tags={"AttributesValues"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete AttributesValues name and slug",
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="string", format="id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not_Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sorry, your data not supported.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                     property="message",
     *                     type="string"
     *              ),
     *          )
     *      ),
     * ),
     *
     *
     */
    public function delete(Request  $request){
        $id = intval($request->id);
        $attr_val = AttributesValues::where('id' , $id);
        if($attr_val->count() > 0){
            $attr_val->delete();
            return response()->json(["message" => "delete"], 200);
        }else{
            return response()->json(["message" => "not found"], 404);
        }
    }
}
