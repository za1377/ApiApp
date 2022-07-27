<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\UPattributeRequest;
use App\Http\Resources\AttributeResource;

class AttributeController extends Controller
{
    /**
     * display data of Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Attributes",
     *      summary="Show all of Attribute",
     *      description="display all of Attribute",
     *      tags={"Attributes"},
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
        $Attributes = Attributes::all();

        if($Attributes->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return AttributeResource::collection(Attributes::all());

    }

    /**
     * insert data to Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Attribute",
     *      summary="insert the name of the Attributes that use in categories",
     *      description="insert name and slug by admin",
     *      tags={"Attributes"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass Attributes name and slug",
     *          @OA\JsonContent(
     *              required={"name","slug"},
     *              @OA\Property(property="name", type="string", format="name", example="Warehouse"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/Warehouse"),
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
     */
    public function insert(AttributeRequest  $request){

        try{
            $Attribute = Attributes::create([
                "name" => $request->name,
                "slug" => $request->slug]);

        }catch(\Exception $e){
            return response()->json(['message' , 'your data not insert.'],400);
        }

        return new AttributeResource($Attribute);
    }

    /**
     * update the specefic data of Attribute's table
     *
     * @param  App\Http\Requests\UPattributeRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Attribute",
     *      summary="update the name of the Attributes that use in categories",
     *      description="update name and slug by admin",
     *      tags={"Attributes"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass Attributes name and slug",
     *          @OA\JsonContent(
     *              required={"id","name","slug"},
     *              @OA\Property(property="id", type="string", format="id", example="1"),
     *              @OA\Property(property="name", type="string", format="name", example="elevator"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/elevator"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="bad request",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sorry, your data not supported.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not_Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sorry, your data not found.")
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
    public function update(UPattributeRequest  $request){
        $id = intval($request->id);
        $data = array();

        if($request->name != ""){
            $data += ['name' => $request->name];
        }
        if($request->slug != ""){
            $data += ['slug' => $request->slug];
        }

        if($data == []){
            return response()->json(['message' , 'nothing for update.'],400);
        }

        try{
            Attributes::where("id" , $id)->update($data);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not update.'],400);
        }

        return new AttributeResource(Attributes::find($id));
    }

    /**
     * delete the specefic data of Attribute's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Attribute",
     *      summary="delete the row of the Attributes that is determined",
     *      description="update name and slug by admin",
     *      tags={"Attributes"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete Attributes name and slug",
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="string", format="id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not_Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
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
     */
    public function delete(Request  $request){
        $id = intval($request->id);
        $Attribute = Attributes::where('id' , $id);
        if($Attribute->count() > 0){
            $Attribute->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
