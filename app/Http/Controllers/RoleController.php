<?php

namespace App\Http\Controllers;

use App\Http\Resources\RolesResource;
use App\Models\Role;
use Exception;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //
    public function index (Request $request) : JsonResponse{
        try{
            $roles = Role::all();
            return response()->json(['success' => true , 'data' => RolesResource::collection($roles) ]);
        }catch(Exception $ex){
            return response()->json(['error'=> true , 'message'=>'Something went wrong fetching data'],500);
        }
    }

    public function createRole (Request $request) : JsonResponse {

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255'
        ]);


        if($validator-> fails()){
            return response()->json(['error'=> true , 'errors'=> $validator->errors()] , 422);
        }

        try{
            $roleFromModal = Role::where('name',$request->name)->first();
            if($roleFromModal){
                return response()->json(['error' => true , 'message' => 'Similar role already exists'] , 500);
            }
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            return response()->json(['success' => true , 'message' => 'Successfully created role', 'role' => $role], 201);

        }catch(Exception $exception){
            return response()->json(['error'=> true , 'message'=> 'Failed to create role'] , 500);
        }
    }

    public function updateRole ( Request $request , int $role ) : JsonResponse {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json(['error'=> true , 'message' => $validator->errors()] , 422);
        }

        try{

            $roleFromModal = Role::find($role);
            if(!$roleFromModal){
                return response()->json(['error'=> true , 'message'=> 'Unable to find given role'] , 404);
            }
            $roleFromModal->name = $request->name;
            $roleFromModal->save();
            return response()->json(['success' => true, 'message' => 'Successfully updated role', 'role' => $role], 201);

        }catch(Exception $ex){
            return response()->json(['error'=> true , 'message' => 'Unable to update role'] , 500);
        }
    }

    public function deleteRole ( Request $request , int $role) : JsonResponse {
        try{
            $isRoleInModal = Role::find($role);
            if(!$isRoleInModal){
                return response()->json(['error'=> true , 'message' => 'Role not Found'] , 404);
            }
            $isRoleInModal->delete();
            return response()->json(['success'=> true , 'message'=>'Sucessfully deleted role'],200);
        }catch(Exception $exception){
            return response()->json(['error'=> true , 'message'=> 'Failed to delete role'] , 500);
        }
    }
}
