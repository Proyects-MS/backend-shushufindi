<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProcedureResource;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends BaseController
{
    public function index()
    {
        $procedure = Procedure::all();
        return $this->sendResponse(ProcedureResource::collection($procedure), 'Procedimientos Recuperados Correctamente.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $procedure = Procedure::create($input);
        return $this->sendResponse(new ProcedureResource($procedure), 'Procedimiento Creado Correctamente.');
    }

    public function show($id)
    {
        $procedure = Procedure::find($id);
        if (is_null($procedure)) {
            return $this->sendError('Procedimiento no Encontrado.');
        }
        return $this->sendResponse(new ProcedureResource($procedure), 'Procedimiento Recuperado Correctamente.');
    }

    public function update(Request $request, $id)
    {
        $procedure = Procedure::find($id);
        $procedure->name = $request->input('name');
        $procedure->id_hiring = $request->input('id_hiring');
        $procedure->save();
        return $this->sendResponse(new ProcedureResource($procedure), 'Procedimiento Actualizado Correctamente.');
    }

    public function destroy($id)
    {
        $procedure = Procedure::find($id)->delete();
        return $this->sendResponse([], 'Procedimiento Eliminado Correctamente.');
    }

}
