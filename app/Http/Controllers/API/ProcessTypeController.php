<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProcessTypeResource;
use App\Models\ProcessType;
use Illuminate\Http\Request;

class ProcessTypeController extends BaseController
{
    public function index()
    {
        $process_type = ProcessType::all();
        return $this->sendResponse(ProcessTypeResource::collection($process_type), 'Tipos de Procesos Recuperados Correctamente.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $process_type = ProcessType::create($input);
        return $this->sendResponse(new ProcessTypeResource($process_type), 'Tipo de Proceso Creado Correctamente.');
    }

    public function show($id)
    {
        $process_type = ProcessType::find($id);
        if (is_null($process_type)) {
            return $this->sendError('Tipo de Proceso no Encontrado.');
        }
        return $this->sendResponse(new ProcessTypeResource($process_type), 'Tipo de Proceso Recuperado Correctamente.');
    }

    public function update(Request $request, $id)
    {
        $process_type = ProcessType::find($id);
        $process_type->name = $request->input('name');
        $process_type->save();
        return $this->sendResponse(new ProcessTypeResource($process_type), 'Tipo de Proceso Actualizado Correctamente.');
    }

    public function destroy($id)
    {
        $process_type = ProcessType::find($id)->delete();
        return $this->sendResponse([], 'Tipo de Proceso Eliminado Correctamente.');
    }
}
