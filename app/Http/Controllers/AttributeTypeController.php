<?php

namespace App\Http\Controllers;

use App\Models\AttributesTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AttributeTypeController extends Controller
{
    /**
     * display data of AttributesType's table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return response
     *
     * @OA\Get(
     * path="/Show/Attributes/Types",
     * summary="Show all of AttributesType",
     * description="display all of AttributesType",
     * tags={"AttributesType"},

     * @OA\Response(
     *    response=404,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Not found.")
     *        )
     *     )
     * ),
     *
     *
     */
    public function show(){
        $attr_type = AttributesTypes::all();

        if($attr_type->count() <= 0){
            return response()->json(['massege' => 'not found.'], 404);
        }else{
            return response()->json($attr_type, 200);
        }
    }
}
