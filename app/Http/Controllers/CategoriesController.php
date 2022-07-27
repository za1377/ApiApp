<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UPcategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    /**
     * display data of categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Categories",
     *      summary="Show all of categories",
     *      description="display all of categories",
     *      tags={"categories"},
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
        $category = categories::all();
        if($category->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return CategoryResource::collection(categories::all());

    }

    /**
     * insert data to categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Category",
     *      summary="insert the name of the categories",
     *      description="insert name and slug by admin and if it has parent it's parent shloud insert too",
     *      tags={"categories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and slug",
     *          @OA\JsonContent(
     *              required={"name","slug"},
     *              @OA\Property(property="name", type="string", format="name", example="home"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/home"),
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
    public function insert(CategoryRequest  $request){
        try{
            $category = categories::create([
                "name" => $request->name,
                "slug" => $request->slug,
                "parent_id" => $request->parent_id]);
                
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not insert.'],400);
        }

        return new CategoryResource($category);

    }

    /**
     * update the specefic data of categories table
     *
     * @param  App\Http\Requests\UPcategoryRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Category",
     *      summary="update the name row of the categories table",
     *      description="update name and slug and parent's id by admin",
     *      tags={"categories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and slug",
     *          @OA\JsonContent(
     *              required={"id","name","slug"},
     *              @OA\Property(property="id", type="string", format="id", example="1"),
     *              @OA\Property(property="name", type="string", format="name", example="Clothing"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/Clothing"),
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
     */
    public function update(UPcategoryRequest  $request){
        $id = intval($request->id);
        $data = array();

        if($request->name != ""){
            $data += ['name' => $request->name];
        }
        if($request->slug != ""){
            $data += ['slug' => $request->slug];
        }
        if($request->parent_id != ""){
            $data += ['parent_id' => $request->parent_id];
        }

        if($data == []){
            return response()->json(['message' , 'nothing for update.'],400);
        }

        try{
            categories::where('id' , $id)->update($data);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not update.'],400);
        }

        return new CategoryResource(categories::find($id));

    }

    /**
     * delete the specefic data of categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Category",
     *      summary="delete the row of the brands that is determined",
     *      description="update name and slug by admin",
     *      tags={"categories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete categories row from it's table",
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
        $category = categories::where('id' , $id);
        if($category->count() > 0){
            $category->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
