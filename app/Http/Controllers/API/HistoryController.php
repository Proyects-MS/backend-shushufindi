<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

use App\Models\History;
use App\Http\Resources\HistoryResource;

class HistoryController extends BaseController
{
    public function index()
    {
        $history = History::all();
        return $this->sendResponse(HistoryResource::collection($history), 'Historial Recuperado Correctamente.');
    }

    public function store(Request $request)
    {
        $history = new History();
        $history->description = $request->input('description');
        $history->date = $request->input('date');
        $history->task_id = $request->input('task_id');
        $history->process_id = $request->input('process_id');
        $history->file_id = $request->input('file_id');
        $history->save();

        return $this->sendResponse(new HistoryResource($history), 'Historial Creado Correctamente.');
    }

    public function show($id)
    {
        $history = History::find($id);

        if (is_null($history)) {
            return $this->sendError('Historial no encontrado.');
        }

        return $this->sendResponse(new HistoryResource($history), 'Historial Recuperado Correctamente.');
    }

    public function update($id)
    {
        $history = History::find($id);
        $history->description = $request->input('description');
        $history->date = $request->input('date');
        $history->task_id = $request->input('task_id');
        $history->process_id = $request->input('process_id');
        $history->file_id = $request->input('file_id');
        $history->save();

        return $this->sendResponse(new HistoryResource($history), 'Historial Actualizado Correctamente.');
    }

    public function destroy($id)
    {
        $permission = History::find($id)->delete();
        return $this->sendResponse([], 'Historial Eliminado Correctamente.');
    }

    public function HistProcess($process_id)
    {
        $History = History::where('process_id', $process_id)
        ->orderBy('id', 'asc')
        ->get();

        return $this->sendResponse(HistoryResource::collection($History), 'Datos de Involucrado recuperados correctamente.');
    }
}
