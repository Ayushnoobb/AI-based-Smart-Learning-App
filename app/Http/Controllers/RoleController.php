<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //
    public function index (Request $request){

    }

    public function createRole (Request $request) : JsonResponse {

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255'
        ]);
        

        if($validator-> fails()){
            return response()->json(['error' => $validator->errors()] , 422);
        }

        try{

            $role = new Role();
            $role->name = $request->name;
            $role->save();

        }catch(Exception $exception){
            return response()->json(['error'=> 'Failed to create role'] , 500);
        }
    }

    public function updateRole ( Request $request ) : JsonResponse {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()] , 422);
        }
        try{

        }catch(Exception $ex){
            return response()->json(['error' => 'Unable to update role'] , 500);
        }
    }
}
