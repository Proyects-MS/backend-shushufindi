<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Resources\FolderResource;

class FolderController extends BaseController
{
    public function index()
    {
        $data = Folder::all();

        //return $data;
        return $this->sendResponse(FolderResource::collection($data), 'Carpetas Recuperadas Correctamente.');
    }

    public function store(Request $request)
    {
        $data = new Folder();
        $data->name = $request->input('name');
        $data->parent = $request->input('parent');
        $data->save();
        return $this->sendResponse(new FolderResource($data), 'Carpeta Creada Correctamente.');
    }

    public function show($id)
    {
        $folder = Folder::find($id);

        if (is_null($folder)) {
            return $this->sendError('Carpeta no encontrada.');
        }

        return $this->sendResponse(new FolderResource($folder), 'Datos de Carpeta recuperados correctamente.');
    }

    public function update(Request $request, $id)
    {
        $data = Folder::find($id);
        $data->name = $request->input('name');
        $data->parent = $request->input('parent');
        $data->save();
        return $this->sendResponse(new FolderResource($data), 'Carpeta Editada Correctamente.');
    }

    public function destroy($id)
    {
        $data = Folder::find($id);
        $data->delete();
        return $this->sendResponse([], 'Carpeta Eliminada Correctamente.');
    }


}
