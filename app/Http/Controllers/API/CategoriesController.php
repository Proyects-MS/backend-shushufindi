<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Resources\CategoriesResource;

class CategoriesController extends BaseController
{
    
    public function index()
    {  
        $data = Categories::orderBy('name','ASC')->get();
        return $this->sendResponse(CategoriesResource::collection($data), 'Categorias Recuperadas Correctamente.');
    }

    public function store(Request $request)
    {
        $data = new Categories();
        $data->name = $request->input('name');
        $data->save();
        return $this->sendResponse(new CategoriesResource($data), 'Categoria Creada Correctamente.');
    }

    public function show($id)
    {
        $data = Categories::find($id);
        if (is_null($data)) {
            return $this->sendError('Categoria no encontrada.');
        }
        return $this->sendResponse(new CategoriesResource($data), 'Datos de Categoria recuperados correctamente.');
    }

    public function update(Request $request, $id)
    {
        $data = Categories::find($id);
        $data->name = $request->input('name');
        $data->save();
        return $this->sendResponse(new CategoriesResource($data), 'Categoria Editada Correctamente.');
    }


    public function destroy($id)
    {
        $data = Categories::find($id)->delete();
        return $this->sendResponse([], 'Categoria Eliminada Correctamente.');
    }


}
