<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Process;
use App\Models\Involucrados;
use App\Models\Tasks;
use App\Http\Resources\ProcessResource;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProcessController extends BaseController
{
    public function index()
    {
        $data = Process::all();

        //return $data;
        return $this->sendResponse(ProcessResource::collection($data), 'Procesos Recuperados Correctamente.');
    }

    public function store(Request $request)
    {
        $data = new Process();
        $data->name = $request->input('name');
        $data->date = $request->input('date');
        $data->user_asig_id = $request->input('user_asig_id');
        $data->user_id = $request->input('user_id');
        $data->description = $request->input('description');
        $data->state_id = $request->input('state_id');
        $data->last_updated_user = $request->input('last_updated_user');
        $data->priority = $request->input('priority');
        $data->hiring = $request->input('hiring');
        $data->procedures = $request->input('procedures');
        $data->time = $request->input('time');
        $data->ending = $request->input('ending');
        $data->hiring_class = $request->input('hiring_class');
        $data->sequential = $request->input('sequential');
        $data->last_assign_date = $request->input('last_assign_date');
        $data->save();
        return $this->sendResponse(new ProcessResource($data), 'Proceso Creado Correctamente.');
    }

    public function show($id)
    {
        $process = Process::find($id);

        if (is_null($process)) {
            return $this->sendError('Proceso no encontrado.');
        }

        return $this->sendResponse(new ProcessResource($process), 'Datos de Proceso recuperados correctamente.');
    }

    public function update(Request $request, $id)
    {
        $data = Process::find($id);
        $data->name = $request->input('name');
        $data->user_asig_id = $request->input('user_asig_id');
        $data->description = $request->input('description');
        $data->state_id = $request->input('state_id');
        $data->last_updated_user = $request->input('last_updated_user');
        $data->save();

        // $user = User::where('users.id', $data->user_asig_id)->first();

        // $process = Process::where('process.id', $data->id)->first();

        // $details["user"] = $user->name;

        // $details["inicio"] = "Tiene Asignado el trámite número " .$process->sequential. " en su bandeja con el nombre: ".$process->name. ", tiene: ".$process->time." para continuar";

        // Mail::send('mail/CorreoProcess', $details, function ($message) use ($user, $details) {
        //     $message->to($user->email)->subject('Sistema de Gestión de Documental');
        // });

        return $this->sendResponse(new ProcessResource($data), 'Proceso Editado Correctamente.');
    }

    public function destroy($id)
    {
        $data = Process::find($id);
        $data->delete();
        $data = Involucrados::where('process_id', $id)->delete();
        $data = Tasks::where('process_id', $id)->delete();
        
        return $this->sendResponse([], 'Proceso Eliminado Correctamente.');
    }

    public function updateLastDate(Request $request, $id)
    {
        $data = Process::find($id);
        $data->last_assign_date = $request->input('last_assign_date');
        $data->save();
        return $this->sendResponse(new ProcessResource($data), 'Proceso Editado (last_assign_date) Correctamente.');
    }

    public function LastSequential()
    {
        $data = Process::latest('process.id')->first('sequential');

        return $data;
        //return $this->sendResponse(new ProcessResource($data), 'Procesos Recuperados Correctamente.');
    }
}
