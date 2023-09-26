<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Hiring;
use App\Http\Resources\HiringResource;
use App\Models\ProcessType;

class HiringController extends BaseController
{

    public function index()
    {
       /*  $process_type = ProcessType::all(); */

        $hiring = Hiring::join('process_type as pro', 'pro.id', 'hiring.id_processtype')
            ->select('hiring.*', 'pro.name as name_processtype')
            ->get();

            
        //return $hiring;
        return $this->sendResponse(HiringResource::collection($hiring), 'Contrataciones Recuperadas Correctamente.');
        
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $hiring = Hiring::create($input);
        return $this->sendResponse(new HiringResource($hiring), 'Contratación Creada Correctamente.');
    }

    public function show($id)
    {
        $hiring = Hiring::find($id);
        if (is_null($hiring)) {
            return $this->sendError('Contratación no encontrada.');
        }
        return $this->sendResponse(new HiringResource($hiring), 'Contratación Recuperada Correctamente.');
    }

    public function update(Request $request, Hiring $hiring)
    {
        $hiring = Hiring::find($hiring->id);
        $hiring->update($request->all());
        return $this->sendResponse(new HiringResource($hiring), 'Contratación Actualizada Correctamente.');
    }

    public function destroy($id)
    {
        $hiring = Hiring::find($id)->delete();
        return $this->sendResponse([], 'Contratación Eliminada Correctamente.');
    }

    public function type_process()
    {
        $process_type = ProcessType::all();
        return $process_type;
    }

}
