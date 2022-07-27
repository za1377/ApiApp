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

        return CateAttrCateResource::collection(Categories_AttributesCategories::all());

    }

    /**
     * insert data to categories__attributes_categories table
     *
     * @param  \App\Http\Requests\CateAttrCateRequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Cate/Attr/Cate",
     *      summary="insert the AttributeCategory's name and Categories' name",
     *      description="insert the name of the AttributeCategory and Category",
     *      tags={"CateAttrCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeCategory name and category name",
     *          @OA\JsonContent(
     *              required={"AttributeCategoryName","CategoryName"},
     *              @OA\Property(property="AttributeCategoryName", type="string", format="name", example="sony"),
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
    public function insert(CateAttrCateRequest  $request)
    {
        $AttrCateId = AttributeCategories::where('name' , $request->AttributeCategoryName)->get('id');
        $CategoryId = categories::where('name' , $request->CategoryName)->get('id');

        $oldData = Categories_AttributesCategories::where('attre_cate_id' , $AttrCateId[0]->id)
        ->where('cate_id' , $CategoryId[0]->id)->get();

        if($oldData->count() > 0){
            return response()->json(['message' , 'your data inserted.'],400);
        }

        try{
            $result = Categories_AttributesCategories::create([
                'attre_cate_id' => $AttrCateId[0]->id,
                'cate_id' => $CategoryId[0]->id,
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
     *      summary="update the AttributeCategories's name and Categorie's name",
     *      description="update the AttributeCategories's name and Categorie's name by admin",
     *      tags={"CateAttrCategories"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeCategories name and category name",
     *          @OA\JsonContent(
     *              required={"id","AttributeCategoryName","CategoryName"},
     *              @OA\Property(property="id", type="string", format="id", example="12"),
     *              @OA\Property(property="AttributeCategoryName", type="string", format="name", example="sony"),
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
    public function update(UpdateCateAttrCateRequest  $request){
        $id = intval($request->id);
        $data = array();

        if($request->AttributeCategoryName != ""){
            $AttrCateId = AttributeCategories::where('name' , $request->AttributeCategoryName)->get('id');
            $data += ['attre_cate_id' => $AttrCateId[0]->id];
        }
        if($request->CategoryName != ""){
            $CategoryId = categories::where('name' , $request->CategoryName)->get('id');
            $data += ['cate_id' => $CategoryId[0]->id];
        }

        $query = Categories_AttributesCategories::find($id);

        $oldData = Categories_AttributesCategories::where('attre_cate_id', isset($data['attre_cate_id']) ? $data['attre_cate_id'] : $query->attre_cate_id)
        ->where('cate_id',isset($data['cate_id']) ? $data['cate_id'] : $query->cate_id)->get();

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
                return new CateAttrCateResource(Categories_AttributesCategories::find($id));
            }

        }else{
            return response()->json(['message' => 'Sorry, your data not found.'] , 404);
        }
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
        }else{
            return response()->json(["message" => "not found"], 404);
        }
    }
}
