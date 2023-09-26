<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Files;
use App\Http\Resources\FilesResource;
use App\Models\Involucrados;
use App\Models\Tasks;

class FilesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Files::all();
        return $this->sendResponse(FilesResource::collection($data), 'Archivos Recuperados Correctamente.');
        
    }


    public function store(Request $request)
    {
 
        $data = new Files();
        $data->name = $request->input('name');
        $data->date = $request->input('date');
        $data->user_id = $request->input('user_id');
        $data->ext_file = $request->input('ext_file');
        $data->type = $request->input('type');
        $data->description = $request->input('description');
        $data->url = $request->input('url');
        $data->peso = $request->input('peso');
        $data->last_updated_user = $request->input('last_updated_user');
        $data->process_id = $request->input('process_id');
        $data->category_id = $request->input('category_id');
        $data->save();

        return $this->sendResponse(new FilesResource($data), 'Archivo Creado Correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Files::find($id);
        if (is_null($data)) {
            return $this->sendError('Archivo no encontrado.');
        }
        return $this->sendResponse(new FilesResource($data), 'Archivo Recuperado Correctamente.');
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
        $data = Files::find($id);
        $data->name = $request->input('name');
        $data->ext_file = $request->input('ext_file');
        $data->type = $request->input('type');
        $data->url = $request->input('url');
        $data->peso = $request->input('peso');
        $data->last_updated_user = $request->input('last_updated_user');
        $data->save();
        return $this->sendResponse(new FilesResource($data), 'Archivo Editado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Files::find($id)->delete();
        $data = Tasks::where('file_id', $id)->delete();
        return $this->sendResponse([], 'Archivo Eliminado Correctamente.');
    }

    public function processfile($id)
    {

        $data = Files::leftJoin('process', 'process.id', '=', 'files.process_id')
            ->select('files.*', 'process.name as process_name')
            ->where('files.process_id', $id)
            ->orderBy('files.id', 'DESC')
            ->get();

        if (is_null($data)) {
            return $this->sendError('Archivo no encontrado.');
        }
        return $this->sendResponse(FilesResource::collection($data), 'Archivos recuperados correctamente.');

    }

    public function updateURL(Request $request, $id)
    {
        $data = Files::find($id);
        $data->url = $request->input('url');
        $data->save();
        return $this->sendResponse(new FilesResource($data), 'Archivo Editado Correctamente.');
    }


}
