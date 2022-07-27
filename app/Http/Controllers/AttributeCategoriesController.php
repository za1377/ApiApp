<?php

namespace App\Http\Controllers;

use App\Models\AttributeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AttributeCategoryRequest;
use App\Http\Requests\UPattributeCateRequest;
use App\Http\Resources\AttributeCategoriesResource;

class AttributeCategoriesController extends Controller
{
    /**
     * display data of AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Category/Attributes",
     *      summary="Show all of AttributeCategories",
     *      description="display all of AttributeCategories",
     *      tags={"AttributeCategories"},
     *
     *      @OA\Response(
     *          response=404,
     *          description="Not_Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *     ),
     *
     *      @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *                  ),
     *         )
     *     )
     * ),
     *
     *
     */
    public function show(){
        $cate_attr = AttributeCategories::all();

        if($cate_attr->count() <= 0){
            return response()->json(['massege' => 'Table is empty.'], 404);
        }

        return AttributeCategoriesResource::collection($cate_attr);

    }

    /**
     * insert data to AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Category/Attribute",
     *      summary="insert the name of the AttributeCategories",
     *      description="insert name and slug by admin",
     *      tags={"AttributeCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass attribute categories name and slug",
     *          @OA\JsonContent(
     *              required={"name","slug"},
     *              @OA\Property(property="name", type="string", format="name", example="property"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/property"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *             ),
     *         )
     *      ),
     *      @OA\Response(
     *         response=201,
     *         description="object_created",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *             ),
     *         )
     *      )
     * ),
     *
     */
    public function insert(AttributeCategoryRequest  $request){

        try{
            $cate_attr = AttributeCategories::create([
                "name" => $request->name,
                "slug" => $request->slug]);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not insert.'],400);
        }

        return new AttributeCategoriesResource($cate_attr);

    }

    /**
     * update the specefic data of AttributeCategories table
     *
     * @param  App\Http\Requests\UPattributeCateRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Category/Attribute",
     *      summary="update the name of the AttributeCategories that use in categories",
     *      description="update name and slug by admin",
     *      tags={"AttributeCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and slug",
     *          @OA\JsonContent(
     *              required={"id","name","slug"},
     *              @OA\Property(property="id", type="string", format="id", example="2"),
     *              @OA\Property(property="name", type="string", format="name", example="Possibilities"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/Possibilities"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad_request",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *          )
     *      ),@OA\Response(
     *          response=404,
     *          description="Not_found",
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
     *                     type="boolean"
     *             ),
     *         )
     *      ),
     * ),
     *
     *
     */
    public function update(UPattributeCateRequest  $request){
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
            AttributeCategories::where('id' , $id)->update($data);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not update.'],400);
        }

        return new AttributeCategoriesResource(AttributeCategories::find($id));

    }

    /**
     * delete the specefic data of AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Category/Attribute",
     *      summary="delete the row of the AttributeCategories that is determined",
     *      description="update name and slug by admin",
     *      tags={"AttributeCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete brands name and slug",
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
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *             ),
     *         )
     *      ),
     * ),
     *
     */
    public function delete(Request  $request){
        $id = intval($request->id);
        $cate_attr = AttributeCategories::where('id' , $id);

        if($cate_attr->count() > 0){
            $cate_attr->delete();
            return response()->json(["message" => "delete"], 200);
        }else{
            return response()->json(["message" => "not found"], 404);
        }
    }
}
