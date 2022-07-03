<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;



class BrandsController extends Controller
{
    /**
     * display data of brand's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="/Show/Brands",
     * summary="Show all of brands",
     * description="display all of brands",
     * tags={"brands"},

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
     *         response=200,
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
        $brands = Brands::all();
        if($brands->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }else{
            return response()->json($brands, 200);
        }
    }
    /**
     * insert data to brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     * path="/New/Brands",
     * summary="insert the name of the brands that use in categories",
     * description="insert name and slug by admin",
     * tags={"brands"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass brands name and slug",
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
     *    response=409,
     *    description="conflict",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="These data can not be insert.")
     *        )
     *     )
     * ),
     *
     * @OA\Response(
     *         response=201,
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
            $old_brand = Brands::where($matchThese)->get();
            if($old_brand->count() > 0){
                return response()->json(['message' , 'These data can not be insert.'],409);
            }else{
                $brand = Brands::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
                return response()->json($brand, 200);
            }

        }

    }

    /**
     * update the specefic data of brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     * path="/Update/Brands",
     * summary="update the name of the brands that use in categories",
     * description="update name and slug by admin",
     * tags={"brands"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass brands name and slug",
     *    @OA\JsonContent(
     *       required={"id","name","slug"},
     *       @OA\Property(property="id", type="string", format="id", example="12"),
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
     *    response=404,
     *    description="Not_Found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, your data not found.")
     *        )
     *     )
     * ),
     *
     * @OA\Response(
     *         response=202,
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

        $result = Brands::where('slug' , $request->slug)->get();
        if($result->count() > 0){
            return response()->json(['message' , 'These data can not be insert.'],409);
        }

        $query = Brands::find($id);

        if(! is_null($query)){

            if($data == []){
                return response()->json(['message' , 'nothing for update.'],422);
            }else{
                $brand = $query->update($data);
                return response()->json($brand, 200);
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
     * path="/Delete/Brands",
     * summary="delete the row of the brands that is determined",
     * description="update name and slug by admin",
     * tags={"brands"},
     * @OA\RequestBody(
     *    required=true,
     *    description="delete brands name and slug",
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
     *  @OA\Response(
     *         response=203,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string"
     *                  ),
     *         )
     *     ),
     *
     */
    public function delete(Request  $request){
        $id = intval($request->id);
        $brand = Brands::where('id' , $id);
        if($brand->count() > 0){
            $brand->delete();
            return response()->json(["message" => "delete"], 200);
        }else{
            return response()->json(["message" => "not found"], 404);
        }
    }
}
