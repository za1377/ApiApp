<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use App\Http\Requests\UP_AdRequest;
use App\Models\Ads;
use App\Models\AdsAttribute;
use Auth;
use App\Http\Resources\AdResource;

class AdsController extends Controller
{
    /**
     * display data of Ad's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     *      path="/Ads",
     *      summary="Show all of Ads",
     *      description="display all of Ads",
     *      tags={"ADs"},
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
        $Ads = Ads::all();
        if($Ads->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }

        return AdResource::collection($Ads);

    }

    /**
     * insert data to Ads table
     *
     * @param  \App\Http\Requests\AdRequest  $request
     * @return response
     *
     * @OA\Post(
     *      path="/Ad",
     *      summary="insert Ad by user",
     *      tags={"ADs"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass brand id and category id and array of attributes",
     *          @OA\JsonContent(
     *              required={"brand_id","category_id","attribute_id" ,"attribute_value"},
     *              @OA\Property(property="brand_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="category_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="attributes", type="array", format="array",
     *                  example="[{"attribute_id" : 1 , "attribute_value" : [123]},
     *                            {"attribute_id" : 1 , "attribute_value" : ["123"]}]"),
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
    public function insert(AdRequest  $request){
        $user = Auth::user();

        try{
            $Ad = Ads::create([
                "user_id" => $user->id,
                "brand_id" => $request->Ad_id,
                "category_id" => $request->category_id]);

            foreach($request["attributes"] as $attr){
                for($i=0 ; $i<count($attr["attribute_value"]) ; $i++){
                    $AdAttribute = AdsAttribute::create([
                        "ads_id" => $Ad->id,
                        "attribute_id" => $attr["attribute_id"],
                        "attribute_value" => $attr["attribute_value"][$i]]);
                }
            }

        }catch(\Exception $e){
            return response()->json(['message' , 'your data not insert.'],400);
        }

        return new AdResource($Ad);

    }

    /**
     * update the specefic data of Ads table
     *
     * @param  App\Http\Requests\UP_AdRequest  $request
     * @return response
     *
     * @OA\Put(
     *      path="/Ad",
     *      summary="update the Ad table",
     *      description="update the Ad table by user",
     *      tags={"ADs"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass Ad id and category id and array of attributes",
     *          @OA\JsonContent(
     *              required={"Ad_id","category_id","attribute_id" ,"attribute_value"},
     *              @OA\Property(property="Ad_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="category_id", type="integer", format="id", example="1"),
     *              @OA\Property(property="attributes", type="array", format="array",
     *                  example="[{"attribute_id" : 1 , "attribute_value" : [123]},
     *                            {"attribute_id" : 1 , "attribute_value" : ["123"]}]"),
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
    public function update(UP_AdRequest  $request){
        $id = intval($request->id);

        try{
            Ads::where("id" , $id)->update([
                "brand_id" => $request->brand_id,
                "category_id" => $request->category_id]);

            AdsAttribute::where('ads_id' ,$id)->delete();

            foreach($request["attributes"] as $attr){
                for($i=0 ; $i<count($attr["attribute_value"]) ; $i++){
                    $AdAttribute = AdsAttribute::create([
                        "ads_id" => $id,
                        "attribute_id" => $attr["attribute_id"],
                        "attribute_value" => $attr["attribute_value"][$i]]);
                }
            }

        }catch(\Exception $e){
            dd($e);
            return response()->json(['message' , 'your data not update.'],400);
        }

        return new AdResource(Ads::find($id));
    }

    /**
     * delete the specefic data of Ads table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Delete(
     *      path="/Ad",
     *      summary="delete the row of the Ad that is determined",
     *      description="delete Ad by user",
     *      tags={"ADs"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="delete Ad",
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
        $Ad = Ads::where('id' , $id);
        if($Ad->count() > 0){
            $Ad->delete();
            return response()->json(["message" => "delete"], 200);
        }

        return response()->json(["message" => "not found"], 404);

    }
}
