<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 * path="/insert_brands",
 * summary="insert the name of the brands that use in categories",
 * description="insert name and slug by admin",
 * operationId="insertBrands",
 * tags={"insert"},
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
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                     property="id",
 *                     type="biginteger"
 *                  ),
 *         )
 *     )
 */

class InsertController extends Controller
{
    /**
     * insert data to brands table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     */
    public function insert(Request  $request){

    }
}
