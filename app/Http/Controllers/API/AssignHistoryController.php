<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\AssignHistoryResource;
use App\Models\AssignHistory;
use Illuminate\Http\Request;

class AssignHistoryController extends BaseController
{
    public function index()
    {
        $assignHistory = AssignHistory::all();
        return $this->sendResponse(AssignHistoryResource::collection($assignHistory), 'Historial de Asignaciones Recuperados Correctamente.');
    }

    public function store(Request $request)
    {
        $assignHistory = new AssignHistory();
        $assignHistory->user_id = $request->input('user_id');
        $assignHistory->date = $request->input('date');
        $assignHistory->process_id = $request->input('process_id');
        
        $assignHistory->save();

        return $this->sendResponse(new AssignHistoryResource($assignHistory), 'Historial de Asignación Creado Correctamente.');
    }

    public function show($id)
    {
        $assignHistory = AssignHistory::find($id);

        if (is_null($assignHistory)) {
            return $this->sendError('Historial de Asignación no encontrado.');
        }

        return $this->sendResponse(new AssignHistoryResource($assignHistory), 'Datos de Historial de Asignación recuperados correctamente.');
    }

    public function update($id)
    {
        $assignHistory = AssignHistory::find($id);
        $assignHistory->user_id = $request->input('user_id');
        $assignHistory->process_id = $request->input('process_id');
        $assignHistory->date = $request->input('date');
        $assignHistory->save();

        return $this->sendResponse(new AssignHistoryResource($assignHistory), 'Historial de Asignación Actualizado Correctamente.');
    }

    public function destroy($id)
    {
        $assignHistory = AssignHistory::find($id)->delete();

        return $this->sendResponse([], 'Historial de Asignación eliminado correctamente.');
    }

    public function consultHis($process_id)
    {
        $assignHistory = AssignHistory::where('process_id', $process_id)
        ->orderBy('id', 'asc')
        ->get();

        return $this->sendResponse(AssignHistoryResource::collection($assignHistory), 'Datos de Involucrado recuperados correctamente.');
    }

}
