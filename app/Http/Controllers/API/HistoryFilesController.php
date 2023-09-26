<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\HistoryFiles;
use App\Http\Resources\HistoryFilesResource;



class HistoryFilesController extends BaseController
{
   

    public function store ( Request $request )
    {
        $data = new HistoryFiles();
        $data->file_id = $request->input('file_id');
        $data->description = $request->input('description');
        $data->url = $request->input('url');
        $data->date = $request->input('date');
        $data->reason = $request->input('reason');
        $data->save();
        return $this->sendResponse(new HistoryFilesResource($data), 'Historial de Archivo Creado Correctamente.');
    }

    public function HistFiles($file_id)
    {
        $history = HistoryFiles::where('file_id', $file_id)->get();
        if (is_null($history)) {
            return $this->sendError('Historial de Archivo no encontrado.');
        }
        return $this->sendResponse(HistoryFilesResource::collection($history), 'Tareas de Usuario Asignado Recuperadas Correctamente.');
    }
}
