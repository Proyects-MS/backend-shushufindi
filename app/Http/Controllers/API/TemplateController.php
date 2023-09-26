<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Http\Resources\TemplateResource;

class TemplateController extends BaseController
{

    public function index()
    {
        $template = Template::all();
        return $this->sendResponse(TemplateResource::collection($template), 'Plantillas Recuperadas Correctamente.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $template = Template::create($input);
        return $this->sendResponse(new TemplateResource($template), 'Plantilla Creada Correctamente.');
    }

    public function show($id)
    {
        $template = Template::find($id);
        if (is_null($template)) {
            return $this->sendError('Plantilla no Encontrada.');
        }
        return $this->sendResponse(new TemplateResource($template), 'Plantilla Recuperada Correctamente.');
    }

    public function update(Request $request, $id)
    {
        $template = Template::find($id);
        $template->name = $request->input('name');
        $template->priority = $request->input('priority');
        $template->state_id  = $request->input('state_id ');
        $template->type_process_id  = $request->input('type_process_id ');
        $template->hiring_id  = $request->input('hiring_id ');
        $template->procedure_id  = $request->input('procedure_id ');
        $template->description = $request->input('description');
        $template->save();
        return $this->sendResponse(new TemplateResource($template), 'Plantilla Actualizada Correctamente.');
    }

    public function destroy($id)
    {
        $template = Template::find($id)->delete();
        return $this->sendResponse([], 'Plantilla Eliminada Correctamente.');
    }
    
}
