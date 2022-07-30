<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttrTypeCACARequest;
use App\Http\Requests\UPattrTypeCACARequest;
use App\Http\Resources\AttrTypeCACAResource;
use App\Models\AttributesTypes_caa;

class AttrTypeCACAController extends Controller
{
    /**
     * display data of AttributeType and CACA
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/CACA/AttributeTypes",
     *      summary="Show all rows of attributes_types_caa table",
     *      description="display all rows of attributes_types_caa table",
     *      tags={"AttrTypeCAA"},
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
        $result = AttributesTypes_caa::all();
        if($result->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return AttrTypeCACAResource::collection(AttributesTypes_caa::all());

    }

    /**
     * insert data to attributes_types_caa table
     *
     * @param  \App\Http\Requests\AttrTypeCACARequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/CACA/AttributeType",
     *      summary="insert the AttributeType's id and CACA's id",
     *      description="insert the ID of the AttributeType and CACA",
     *      tags={"AttrTypeCAA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeType id and CACA id",
     *          @OA\JsonContent(
     *              required={"attribute_type_id","caa_id"},
     *              @OA\Property(property="attribute_type_id", type="integer", format="id", example="1"),
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
    public function insert(AttrTypeCACARequest  $request)
    {
        try{
            $result = AttributesTypes_caa::create([
                'caa_id' => $request->caa_id,
                'attribute_type_id' => $request->attribute_type_id,
            ]);

        }catch(\Exception $e) {
            return response()->json(['message' , 'your data can not insert.'],400);
        }

        return new AttrTypeCACAResource($result);

    }

    /**
     * update the specefic data of attributes_types_caa table
     *
     * @param  App\Http\Requests\UPattrTypeCACARequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/CACA/AttributeType",
     *      summary="update the AttributeType's id and CACA's id",
     *      description="update the AttributeType's id and CACA's id by admin",
     *      tags={"AttrTypeCAA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass AttributeType id and CACA id",
     *          @OA\JsonContent(
     *              required={"id","attribute_type_id","caa_id"},
     *              @OA\Property(property="id", type="integer", format="id", example="12"),
     *              @OA\Property(property="attribute_type_id", type="integer", format="name", example="1"),
     *              @OA\Property(property="caa_id", type="integer", format="name", example="1"),
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
    public function update(UPattrTypeCACARequest  $request){
        $id = intval($request->id);

        try{
            AttributesTypes_caa::where('id' , $id)->update([
                'caa_id' => $request->caa_id,
                'attribute_type_id' => $request->attribute_type_id,
            ]);
        }catch(\Exception $e){
            return response()->json(['message' , 'your data can not update.'],400);
        }
        return new AttrTypeCACAResource(AttributesTypes_caa::find($id));

    }

    /**
     * delete the specefic data of attributes_types_caa table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/CACA/AttributeType",
     *      summary="delete the row of the attributes_types_caa table that is determined",
     *      description="delete row of the attributes_types_caa table by admin",
     *      tags={"AttrTypeCAA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete from attributes_types_caa table",
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
        $result = AttributesTypes_caa::where('id' , $id);
        if($result->count() > 0){
            $result->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);
    }
}
