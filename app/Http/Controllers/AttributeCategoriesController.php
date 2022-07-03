<?php

namespace App\Http\Controllers;

use App\Models\AttributeCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AttributeCategoriesController extends Controller
{
    /**
     * display data of AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="Show/Categories/Attribute",
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
        $cate_attr = AttributeCategories::all();
        return response()->json($cate_attr, 200);
    }

    /**
     * insert data to AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Post(
     * path="/New/Categories/Attribute",
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

        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' , 'Sorry, your data not supported'],422);
        }else{
            $matchThese = ['slug' => $request->slug];
            $old_cate_attr = AttributeCategories::where($matchThese)->get();
            if($old_cate_attr->count() > 0){
                return response()->json(['message' , 'These data can not be insert.'],409);
            }else{
                $cate_attr = AttributeCategories::create([
                    "name" => $request->name,
                    "slug" => $request->slug]);
                return response()->json($cate_attr, 200);
            }

        }

    }

    /**
     * update the specefic data of AttributeCategories table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Put(
     * path="/Update/Categories/Attribute",
     * summary="update the name of the AttributeCategories that use in categories",
     * description="update name and slug by admin",
     * tags={"AttributeCategories"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass brands name and slug",
     *    @OA\JsonContent(
     *       required={"id","name","slug"},
     *       @OA\Property(property="id", type="string", format="id", example="2"),
     *       @OA\Property(property="name", type="string", format="name", example="weight"),
     *       @OA\Property(property="slug", type="string", format="slug", example="/weight"),
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
     *         response=210,
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

        $result = AttributeCategories::where('slug' , $request->slug)->get();
        if($result->count() > 0){
            return response()->json(['message' , 'These data can not be insert.'],409);
        }

        $query = AttributeCategories::find($id);

        if(! is_null($query)){

            if($data == []){
                return response()->json(['message' , 'nothing for update.'],422);
            }else{
                $cate_attr = $query->update($data);
                return response()->json($cate_attr, 200);
            }

        }else{
            return response()->json(['message' => 'Sorry, your data not found.'] , 404);
        }
    }
}
