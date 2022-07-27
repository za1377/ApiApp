<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\UPbrandRequest;
use App\Http\Resources\BrandResource;

class BrandsController extends Controller
{
    /**
     * display data of brand's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Brands",
     *      summary="Show all of brands",
     *      description="display all of brands",
     *      tags={"brands"},
     *
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
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
     *                  ),
     *         )
     *     )
     * ),
     *
     *
     */
    public function show(){
        $brands = Brands::all();
        if($brands->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return BrandResource::collection(Brands::all());

    }

    /**
     * insert data to brands table
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Brand",
     *      summary="insert the name of the brands that use in categories",
     *      description="insert name and slug by admin",
     *      tags={"brands"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and slug",
     *          @OA\JsonContent(
     *              required={"name","slug"},
     *              @OA\Property(property="name", type="string", format="name", example="sony"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/sony"),
     *          ),
     *      ),
     *
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
    public function insert(BrandRequest  $request){

        try{
            $brand = Brands::create([
                "name" => $request->name,
                "slug" => $request->slug]);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not insert.'],400);
        }

        return new BrandResource($brand);

    }

    /**
     * update the specefic data of brands table
     *
     * @param  App\Http\Requests\UPbrandRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Brand",
     *      summary="update the name of the brands that use in categories",
     *      description="update name and slug by admin",
     *      tags={"brands"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and slug",
     *          @OA\JsonContent(
     *              required={"id","name","slug"},
     *              @OA\Property(property="id", type="string", format="id", example="12"),
     *              @OA\Property(property="name", type="string", format="name", example="sumsung"),
     *              @OA\Property(property="slug", type="string", format="slug", example="/sumsung"),
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
    public function update(UPbrandRequest  $request){
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
            Brands::where('id' , $id)->update($data);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data not update.'],400);
        }

        return new BrandResource(Brands::find($id));

    }

    /**
     * delete the specefic data of brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Brand",
     *      summary="delete the row of the brands that is determined",
     *      description="update name and slug by admin",
     *      tags={"brands"},
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
        $brand = Brands::where('id' , $id);
        if($brand->count() > 0){
            $brand->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
