<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandCategoryRequest;
use App\Http\Requests\updateBCategoryRequest;
use App\Http\Resources\BrandCategoryResource;
use App\Models\Brands;
use App\Models\categories;
use App\Models\BrandsCategories;

class BrandCategoryController extends Controller
{
    /**
     * display data of brands_categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Category/Brands",
     *      summary="Show all rows of brands_categories table",
     *      description="display all rows of brands_categories table",
     *      tags={"brandOFcategories"},
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
        $brands = BrandsCategories::all();
        if($brands->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return BrandCategoryResource::collection(BrandsCategories::all());

    }

    /**
     * insert data to brands_categories table
     *
     * @param  \App\Http\Requests\BrandCategoryRequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Category/Brand",
     *      summary="insert the Brand's name and Categorie's name",
     *      description="insert the name of the Brand and Category",
     *      tags={"brandOFcategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and category name",
     *          @OA\JsonContent(
     *              required={"BrandName","CategoryName"},
     *              @OA\Property(property="BrandName", type="string", format="name", example="sony"),
     *              @OA\Property(property="CategoryName", type="string", format="name", example="/phone"),
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
    public function insert(BrandCategoryRequest  $request){

        $BrandId = Brands::where('name' , $request->BrandName)->get('id');
        $CategoryId = categories::where('name' , $request->CategoryName)->get('id');

        $oldData = BrandsCategories::where('brand_id' , $BrandId[0]->id)
        ->where('category_id' , $CategoryId[0]->id)->get();

        if($oldData->count() > 0){
            return response()->json(['message' , 'your data inserted.'],400);
        }

        try{
            $result = BrandsCategories::create([
                'brand_id' => $BrandId[0]->id,
                'category_id' => $CategoryId[0]->id,
            ]);

        }catch(\Exception $e) {
            return response()->json(['message' , 'your data can not insert.'],400);
        }

        return new BrandCategoryResource($result);

    }

    /**
     * update the specefic data of brands_categories table
     *
     * @param  App\Http\Requests\updateBCategoryRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Category/Brand",
     *      summary="update the Brand's name and Categorie's name",
     *      description="update the Brand's name and Categorie's name by admin",
     *      tags={"brandOFcategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brands name and category name",
     *          @OA\JsonContent(
     *              required={"id","BrandName","CategoryName"},
     *              @OA\Property(property="id", type="string", format="id", example="12"),
     *              @OA\Property(property="BrandName", type="string", format="name", example="sony"),
     *              @OA\Property(property="CategoryName", type="string", format="name", example="/phone"),
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
    public function update(updateBCategoryRequest  $request){
        $id = intval($request->id);
        $data = array();

        if($request->BrandName != ""){
            $BrandId = Brands::where('name' , $request->BrandName)->get('id');
            $data += ['brand_id' => $BrandId[0]->id];
        }
        if($request->CategoryName != ""){
            $CategoryId = categories::where('name' , $request->CategoryName)->get('id');
            $data += ['category_id' => $CategoryId[0]->id];
        }

        $query = BrandsCategories::find($id);

        $oldData = BrandsCategories::where('brand_id', isset($data['brand_id']) ? $data['brand_id'] : $query->brand_id)
        ->where('category_id',isset($data['category_id']) ? $data['category_id'] : $query->cate_id)->get();

        if($oldData->count() > 0){
            return response()->json(['message' , 'your data inserted.'],400);
        }

        if(! is_null($query)){

            if($data == []){
                return response()->json(['message' , 'nothing for update.'],400);
            }else{
                try{
                    $query->update($data);
                }catch(\Exception $e){
                    return response()->json(['message' , 'your data can not update.'],400);
                }
                return new BrandCategoryResource(BrandsCategories::find($id));
            }

        }
        return response()->json(['message' => 'Sorry, your data not found.'] , 404);

    }

    /**
     * delete the specefic data of brands_categories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Category/Brand",
     *      summary="delete the row of the brands_categories table that is determined",
     *      description="delete row of the brands_categories table by admin",
     *      tags={"brandOFcategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete the id of brand and ctegory that stored",
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
        $brand = BrandsCategories::where('id' , $id);
        if($brand->count() > 0){
            $brand->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
