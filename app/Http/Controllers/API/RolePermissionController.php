<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\RolePermissionResource;
use App\Models\RolePermission;

class RolePermissionController extends BaseController
{
    public function index()
    {
        $rolePermissions = RolePermission::all();

        return response()->json(RolePermissionResource::collection($rolePermissions));

        //return $rolePermissions;
       // return $this->sendResponse(RolePermissionResource::collection($rolePermissions), 'RolePermissions recuperados correctamente.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $data = RolePermission::create($input);
        return $this->sendResponse(new RolePermissionResource($data), 'RolePermission creado correctamente.');
    }

    public function show($role_id)
    {
        $rolePermission = RolePermission::leftJoin('roles', 'roles.id', '=', 'role_to_permissions.role_id')
            ->leftJoin('permissions', 'permissions.id', '=', 'role_to_permissions.permission_id')
            ->select('role_to_permissions.*', 'roles.name as role_name', 'roles.supervisor', 'permissions.name as permission_name', 'permissions.real_name')
            ->where('role_to_permissions.role_id', $role_id)
            ->get();

        if (is_null($rolePermission)) {
            return $this->sendError('RolePermission no encontrado.');
        }
        //return $this->sendResponse(RolePermissionResource::collection($data), 'RolePermission recuperado correctamente.');
        
        return $this->sendResponse($rolePermission, 'RolePermission recuperado correctamente.');
        
    }


    public function update(Request $request, $id)
    {
        $rolePermission = RolePermission::find($id);
        $rolePermission->is_allowed = $request->input('is_allowed');
        $rolePermission->save();

        return $this->sendResponse(new RolePermissionResource($rolePermission), 'RolePermission editado correctamente.');
    }


}
