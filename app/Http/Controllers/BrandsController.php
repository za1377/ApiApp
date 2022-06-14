<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;



class BrandsController extends Controller
{
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
     *                     property="id",
     *                     type="biginteger"
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
    public function update(Request  $request){
        $id = intval($request->id);
        $brand = Brands::find($id)->update([
                    "name" => $request->name,
                    "slug" => $request->slug]);
        return response()->json($brand, 200);
    }
}
