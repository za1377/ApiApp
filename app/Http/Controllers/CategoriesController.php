<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * display data of brand's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="/ShowCategories",
     * summary="Show all of categories",
     * description="display all of categories",
     * tags={"categories"},

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
     *         response=204,
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
        $brands = categories::all();
        return response()->json($brands, 200);
    }

    /**
     * insert data to brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     * path="/NewCategories",
     * summary="insert the name of the categories",
     * description="insert name and slug by admin and if it has parent it's parent shloud insert too",
     * tags={"categories"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass brands name and slug",
     *    @OA\JsonContent(
     *       required={"name","slug"},
     *       @OA\Property(property="name", type="string", format="name", example="home"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/home"),
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
     *         response=205,
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
        $brand = categories::create([
                    "name" => $request->name,
                    "slug" => $request->slug,
                    "parent_id" => $request->parent_id]);
        return response()->json($brand, 200);
    }

        /**
     * update the specefic data of brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     * path="/UpdateCategories",
     * summary="update the name row of the categories table",
     * description="update name and slug and parent's id by admin",
     * tags={"categories"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass brands name and slug",
     *    @OA\JsonContent(
     *       required={"id","name","slug"},
     *       @OA\Property(property="id", type="string", format="id", example="1"),
     *       @OA\Property(property="name", type="string", format="name", example="Clothing"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/Clothing"),
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
     *         response=206,
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
        $brand = categories::find($id)->update([
                    "name" => $request->name,
                    "slug" => $request->slug,
                    "parent_id" => $request->parent_id]);
        return response()->json($brand, 200);
    }
}
