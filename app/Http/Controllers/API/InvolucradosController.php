<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Involucrados;
use App\Http\Resources\InvolucradosResource;

use App\Models\Process;
use App\Http\Resources\ProcessUserResource;

class InvolucradosController extends BaseController
{

    public function index()
    {
        $involucrados = Involucrados::all();
        return $this->sendResponse(InvolucradosResource::collection($involucrados), 'Involucrados Recuperados Correctamente.');
        //return $involucrados;
    }

    public function store(Request $request)
    {
        $involucrados = new Involucrados();
        $involucrados->user_id = $request->input('user_id');
        $involucrados->process_id = $request->input('process_id');
        $involucrados->estado = $request->input('estado');
        $involucrados->save();

        return $this->sendResponse(new InvolucradosResource($involucrados), 'Involucrado Creado Correctamente.');
    }

    public function show($id)
    {
        $involucrados = Involucrados::find($id);

        if (is_null($involucrados)) {
            return $this->sendError('Involucrado no encontrado.');
        }

        return $this->sendResponse(new InvolucradosResource($involucrados), 'Datos de Involucrado recuperados correctamente.');
    }

    public function processinv($process_id){
 
        $involucrados = Involucrados::where('process_id', $process_id)->get();

        return $this->sendResponse(InvolucradosResource::collection($involucrados), 'Datos de Involucrado recuperados correctamente.');

    }

    public function processuser($user_id){
        $process = Involucrados::where('user_id', $user_id)
        ->orderBy('id','DESC')
        ->get();
        return $this->sendResponse(ProcessUserResource::collection($process), 'Datos de Involucrado recuperados correctamente.');

    }

    public function processuserlast($user_id){
        $process = Involucrados::where('user_id', $user_id)
        ->latest()
        ->take(5)
        ->get();
        return $this->sendResponse(ProcessUserResource::collection($process), 'Datos de Involucrado recuperados correctamente.');

    }

    public function destroy($id){
        $data = Involucrados::find($id)->delete();
        return $this->sendResponse([], 'Involucrados eliminados correctamente.');
    }
}
