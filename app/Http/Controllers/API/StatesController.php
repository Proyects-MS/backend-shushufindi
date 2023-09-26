<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\States;
use App\Http\Resources\StatesResource;


class StatesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = States::all();
        //return $data;
        return $this->sendResponse(StatesResource::collection($data), 'Estados Recuperados Correctamente.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new States();
        $data->state = $request->input('state');
        $data->colour = $request->input('colour');
        $data->save();
        return $this->sendResponse(new StatesResource($data), 'Estado Creado Correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = States::find($id);

        if (is_null($data)) {
            return $this->sendError('Estado no encontrado.');
        }

        return $this->sendResponse(new StatesResource($data), 'Datos de Estado recuperados correctamente.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = States::find($id);
        $data->state = $request->input('state');
        $data->colour = $request->input('colour');
        $data->save();
        return $this->sendResponse(new StatesResource($data), 'Estado Editado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = States::find($id)->delete();
        return $this->sendResponse([], 'Estado eliminado correctamente.');
    }
}
