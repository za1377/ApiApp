<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CACARequest;
use App\Http\Requests\UP_CACARequest;
use App\Http\Resources\CACAResource;
use App\Models\CACA;

class CACAController extends Controller
{
    /**
     * display data of attributes_attribute attributes_attribute
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/CACAs",
     *      summary="Show all rows of c_a_c_a table",
     *      description="display all rows of c_a_c_a table",
     *      tags={"CACA"},
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
        $result = CACA::all();
        if($result->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return CACAResource::collection($result);

    }

    /**
     * insert data to c_a_c_a table
     *
     * @param  \App\Http\Requests\CACARequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/CACA",
     *      summary="insert the cate_atrre_cate's id and attributes's id",
     *      description="insert the id of the cate_atrre_cate and attributes",
     *      tags={"CACA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass cate_atrre_cate id and attributes id",
     *          @OA\JsonContent(
     *              required={"cate_atrre_cate_id","attributes_id"},
     *              @OA\Property(property="cate_atrre_cate_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="attributes_id", type="integer", format="id", example="1"),
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
    public function insert(CACARequest  $request){

        try{
            $result = CACA::create([
                'cate_atrre_cate_id' => $request->cate_atrre_cate_id,
                'attributes_id' => $request->attributes_id,
            ]);

        }catch(\Exception $e) {
            return response()->json(['message' , 'your data can not insert.'],400);
        }

        return new CACAResource($result);

    }

    /**
     * update the specefic data of c_a_c_a table
     *
     * @param  App\Http\Requests\UP_CACARequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/CACA",
     *      summary="update the row of c_a_c_a table",
     *      description="update the row of c_a_c_a table by admin",
     *      tags={"CACA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass cate_atrre_cate's id and attributes's id",
     *          @OA\JsonContent(
     *              required={"id","cate_atrre_cate_id","attributes_id"},
     *              @OA\Property(property="id", type="string", format="id", example="12"),
     *              @OA\Property(property="cate_atrre_cate_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="attributes_id", type="integer", format="id", example="1"),
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
    public function update(UP_CACARequest  $request){
        $id = intval($request->id);

        try{
            CACA::where('id' , $id)->update([
                'cate_atrre_cate_id' => $request->cate_atrre_cate_id,
                'attributes_id' => $request->attributes_id,
            ]);
        }catch(\Exception $e){
            dd($e);
            return response()->json(['message' , 'your data can not update.'],400);
        }

        return new CACAResource(CACA::find($id));

    }

    /**
     * delete the specefic data of c_a_c_a table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/CACA",
     *      summary="delete the row of the c_a_c_a table that is determined",
     *      description="delete row of the c_a_c_a table by admin",
     *      tags={"CACA"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete the id of cate_atrre_cate and ctegory that stored",
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
        $result = CACA::where('id' , $id);
        if($result->count() > 0){
            $result->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
