<?php

namespace App\Http\Controllers;

use App\Service\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $roleService;
    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function index(){
        $roles = $this->roleService->getAllRole();
        if ($roles){
            return response()->json([
                'message' => 'Get all roles successfully',
                'status' => 'success',
                'data' => $roles,
                'last_page' => $roles->lastPage()], 
                201);
        }
        else {
            return response()->json([
                'error' => 'Cannot get roles', 
                'status' => 'error'], 
                422);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|between:1,50',
            'description' => 'string|between:1,50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'status' => 'error'], 
                422);
        }
        $id = $request->input('role_id');
        $info = [
            'role_name' => $request->input('role_name'),
            'description' => $request->input('description'),
        ];

        $result = $this->roleService->updateRole($info, $id);
        if ($result){
            return response()->json([
                'message' => 'update role successfully',
                'status' => 'success',
                'data' => $result
            ], 201);
        }
        else{
            return response()->json([
                'error' => 'cannot update role', 
                'status' => 'error'], 
                422);
        }
    }
}
