<?php

namespace App\Http\Controllers;

use App\Models\AttributeCategories;
use Illuminate\Http\Request;

class AttributeCategoriesController extends Controller
{
    /**
     * display data of AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="/Show/AttributeCategories",
     * summary="Show all of AttributeCategories",
     * description="display all of AttributeCategories",
     * tags={"AttributeCategories"},

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
     *         response=208,
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
        $brands = AttributeCategories::all();
        return response()->json($brands, 200);
    }

    /**
     * insert data to AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     * path="/New/AttributeCategories",
     * summary="insert the name of the AttributeCategories",
     * description="insert name and slug by admin",
     * tags={"AttributeCategories"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass attribute categories name and slug",
     *    @OA\JsonContent(
     *       required={"name","slug"},
     *       @OA\Property(property="name", type="string", format="name", example="location"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/location"),
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
     *         response=209,
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
        $brand = AttributeCategories::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
        return response()->json($brand, 200);
    }
}
