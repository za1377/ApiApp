<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttrValCACARequest;
use App\Http\Requests\UPattrValeCACARequest;
use App\Http\Resources\AttrValCACAResource;
use App\Models\AttributesValues_caa;

class AttrValCACAController extends Controller
{
    /**
     * display data of AttributeValue and CACA
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/CACA/AttributeValues",
     *      summary="Show all rows of attributes_values_caa table",
     *      description="display all rows of attributes_values_caa table",
     *      tags={"AtrrValCACA"},
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
        $result = AttributesValues_caa::all();
        if($result->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return AttrValCACAResource::collection($result);

    }

    /**
     * insert data to attributes_values_caa table
     *
     * @param  \App\Http\Requests\AttrValCACARequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/CACA/AttributeValue",
     *      summary="insert the AttributeValue's id and CACA's id",
     *      description="insert the id of the AttributeValue and CACA",
     *      tags={"AtrrValCACA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeValue id and CACA id",
     *          @OA\JsonContent(
     *              required={"attribute_value_id","caa_id"},
     *              @OA\Property(property="attribute_value_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="caa_id", type="integer", format="id", example="1"),
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
    public function insert(AttrValCACARequest  $request)
    {
        try{
            $result = AttributesValues_caa::create([
                'caa_id' => $request->caa_id,
                'attribute_value_id' => $request->attribute_value_id,
            ]);

        }catch(\Exception $e) {
            return response()->json(['message' , 'your data can not insert.'],400);
        }

        return new AttrValCACAResource($result);

    }

    /**
     * update the specefic data of attributes_values_caa table
     *
     * @param  App\Http\Requests\UPattrValeCACARequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/CACA/AttributeValue",
     *      summary="update the AttributeValue's id and CACA's id",
     *      description="update the AttributeValue's id and CACA's id by admin",
     *      tags={"AtrrValCACA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeValue id and CACA id",
     *          @OA\JsonContent(
     *              required={"id","attribute_value_id","caa_id"},
     *              @OA\Property(property="id", type="integer", format="id", example="12"),
     *              @OA\Property(property="attribute_value_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="caa_id", type="integer", format="id", example="1"),
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
    public function update(UPattrValeCACARequest  $request){
        $id = intval($request->id);

        try{
            AttributesValues_caa::where('id' , $id)->update([
                'caa_id' => $request->caa_id,
                'attribute_value_id' => $request->attribute_value_id,
            ]);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data can not update.'],400);
        }
        return new AttrValCACAResource(AttributesValues_caa::find($id));

    }

    /**
     * delete the specefic data of attributes_values_caa table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/CACA/AttributeValue",
     *      summary="delete the row of the attributes_values_caa table that is determined",
     *      description="delete row of the attributes_values_caa table by admin",
     *      tags={"AtrrValCACA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete from attributes_values_caa table",
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
        $result = AttributesValues_caa::where('id' , $id);
        if($result->count() > 0){
            $result->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);
    }
}
