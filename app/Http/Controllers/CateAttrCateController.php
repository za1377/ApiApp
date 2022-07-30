<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\AttributeCategories;
use App\Models\Categories_AttributesCategories;
use App\Http\Requests\CateAttrCateRequest;
use App\Http\Requests\UpdateCateAttrCateRequest;
use App\Http\Resources\CateAttrCateResource;

class CateAttrCateController extends Controller
{

    /**
     * display data of categories__attributes_categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Cate/Attr/Cates",
     *      summary="Show all rows of categories__attributes_categories table",
     *      description="display all rows of categories__attributes_categories table",
     *      tags={"CateAttrCategories"},
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
        $result = Categories_AttributesCategories::all();
        if($result->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return CateAttrCateResource::collection($result);

    }

    /**
     * insert data to categories__attributes_categories table
     *
     * @param  \App\Http\Requests\CateAttrCateRequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Cate/Attr/Cate",
     *      summary="insert the AttributeCategory's id and Category's id",
     *      description="insert the id of the AttributeCategory and Category",
     *      tags={"CateAttrCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeCategory id and category id",
     *          @OA\JsonContent(
     *              required={"AttributeCategoryId","CategoryId"},
     *              @OA\Property(property="AttributeCategoryId", type="integer", format="id", example="1"),
     *              @OA\Property(property="CategoryId", type="integer", format="id", example="1"),
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
    public function insert(CateAttrCateRequest  $request)
    {
        try{
            $result = Categories_AttributesCategories::create([
                'attribute_category_id' => $request->attribute_category_id,
                'category_id' => $request->category_id,
            ]);

        }catch(\Exception $e) {
            dd($e);
            return response()->json(['message' , 'your data can not insert.'],400);
        }

        return new CateAttrCateResource($result);

    }

    /**
     * update the specefic data of categories__attributes_categories table
     *
     * @param  App\Http\Requests\UpdateCateAttrCateRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Cate/Attr/Cate",
     *      summary="update the AttributeCategories's id and Categorie's id",
     *      description="update the AttributeCategories's id and Categorie's id by admin",
     *      tags={"CateAttrCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeCategories id and category id",
     *          @OA\JsonContent(
     *              required={"id","attribute_category_id","category_id"},
     *              @OA\Property(property="id", type="integer", format="id", example="12"),
     *              @OA\Property(property="AttributeCategoryid", type="integer", format="id", example="1"),
     *              @OA\Property(property="Categoryid", type="integer", format="id", example="1"),
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
    public function update(UpdateCateAttrCateRequest  $request){
        $id = intval($request->id);

        $query = Categories_AttributesCategories::find($id);

        try{
            Categories_AttributesCategories::where('id', $id)->update([
                'attribute_category_id' => $request->attribute_category_id,
                'category_id' => $request->category_id,
            ]);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data can not update.'],400);
        }

        return new CateAttrCateResource(Categories_AttributesCategories::find($id));

    }

    /**
     * delete the specefic data of categories__attributes_categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Cate/Attr/Cate",
     *      summary="delete the row of the categories__attributes_categories table that is determined",
     *      description="delete row of the categories__attributes_categories table by admin",
     *      tags={"CateAttrCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete from categories__attributes_categories table",
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
        $result = Categories_AttributesCategories::where('id' , $id);
        if($result->count() > 0){
            $result->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
