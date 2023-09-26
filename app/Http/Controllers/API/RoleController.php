<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\RoleResource;
use App\Models\Permissions;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoleController extends BaseController
{

    public function index()
    {
        $roles = Role::all();
        return $this->sendResponse(RoleResource::collection($roles), 'Roles recuperados correctamente.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $data = Role::create($input);

        $permissions = Permissions::all();

        foreach ($permissions as $permission) {

            RolePermission::create(['role_id' => $data->id, 'permission_id' => $permission->id]);
        }

        return $this->sendResponse(new RoleResource($data), 'Rol creado correctamente.');
    }

    public function show($id)
    {
        $role = Role::find($id);

        if (is_null($role)) {
            return $this->sendError('Role not found.');
        }

        return $this->sendResponse(new RoleResource($role), 'Rol recuperado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->supervisor = $request->input('supervisor');
        $role->save();

        return $this->sendResponse(new RoleResource($role), 'Rol editado correctamente.');
    }

    public function destroy($id)
    {
        $role = Role::find($id)->delete();

        $rolepermission = RolePermission::where('role_id', $id)->delete();

        return $this->sendResponse([], 'Rol eliminado correctamente.');
    }

    public function rolesupervisor($id)
    {
        $role = DB::select("select * from roles where supervisor = (select supervisor from roles where id = '$id') or id = (select supervisor from roles where id = '$id') or supervisor = '$id'");

        return response()->json($role);
    }


}
