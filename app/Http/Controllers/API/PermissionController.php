<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Resources\PermissionResource;

class PermissionController extends BaseController
{
    public function index()
    {
        $permissions = Permission::all();
        return $this->sendResponse(PermissionResource::collection($permissions), 'Permisos Recuperados Correctamente.');
    }

    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->date = $request->input('date');
        $permission->user_asig_id = $request->input('user_asig_id');
        $permission->user_id = $request->input('user_id');
        $permission->description = $request->input('description');
        $permission->state_id = $request->input('state_id');
        $permission->save();
        return $this->sendResponse(new PermissionResource($permission), 'Permiso Creado Correctamente.');
    }

    public function show($id)
    {
        $permission = Permission::find($id);

        if (is_null($permission)) {
            return $this->sendError('Permiso no encontrado.');
        }

        return $this->sendResponse(new PermissionResource($permission), 'Datos de Permiso recuperados correctamente.');
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->date = $request->input('date');
        $permission->user_asig_id = $request->input('user_asig_id');
        $permission->user_id = $request->input('user_id');
        $permission->description = $request->input('description');
        $permission->state_id = $request->input('state_id');
        $permission->save();
        return $this->sendResponse(new PermissionResource($permission), 'Permiso Editado Correctamente.');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id)->delete();
        return $this->sendResponse([], 'Permiso Eliminado Correctamente.');
    }
}
