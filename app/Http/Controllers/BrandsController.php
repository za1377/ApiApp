<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;



class BrandsController extends Controller
{
    /**
     * display data of brand's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="/ShowBrands",
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
        return response()->json($brands, 200);
    }
    /**
     * insert data to brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     * path="/NewBrands",
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
        $brand = Brands::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
        return response()->json($brand, 200);
    }

    /**
     * update the specefic data of brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     * path="/UpdateBrands",
     * summary="update the name of the brands that use in categories",
     * description="update name and slug by admin",
     * tags={"brands"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass brands name and slug",
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
     *         response=202,
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
    public function update(Request  $request){
        $id = intval($request->id);
        $brand = Brands::find($id)->update([
                    "name" => $request->name,
                    "slug" => $request->slug]);
        return response()->json($brand, 200);
    }

        /**
     * update the specefic data of brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     * path="/DeleteBrands",
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
        Brands::find($id)->delete();
        return response()->json(["message" => "delete"], 200);
    }
}
