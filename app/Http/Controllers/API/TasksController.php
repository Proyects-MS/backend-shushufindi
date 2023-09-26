<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Resources\TasksResource;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Process;

class TasksController extends BaseController
{
    public function index()
    {
        $tasks = Tasks::all();
        return $this->sendResponse(TasksResource::collection($tasks), 'Tareas Recuperadas Correctamente.');
    }

    public function store(Request $request)
    {
        $tasks = new Tasks();
        $tasks->name = $request->input('name');
        $tasks->description = $request->input('description');
        $tasks->date = $request->input('date');
        $tasks->user_id = $request->input('user_id');
        $tasks->user_asig_id = $request->input('user_asig_id');
        $tasks->process_id = $request->input('process_id');
        $tasks->file_id = $request->input('file_id');
        $tasks->status = $request->input('status');
        $tasks->save();

        //  //email al asignado
        //  $user_asig = User::where('users.id', $tasks->user_asig_id)->first();
        //     //nombre del usuario que asigna
        //  $user = User::where('users.id', $tasks->user_id)->first();

        //  $tasks = Tasks::where('tasks.id', $tasks->id)->first();

        //  $process = Process::where('process.id', $tasks->process_id)->first();

        // // $details["inicio"] = "La tarea: " .$tasks->name. " con fecha: " .$tasks->date. " fue asignada a usted por: ".$user->name;

        // $details["user"] = $user_asig->name;

        //  $details["inicio"] = "Se le ha asignado a usted una tarea en el Sistema de Gestión Documental con el nombre: " .$tasks->name. " 
        //  , número del proceso: " .$process->sequential. " 
        //  , nombre del proceso: " .$process->name. " 
        //  , fecha: " .$tasks->date. " 
        //  , asignado a usted por el usuario: ".$user->name . ", favor revisar lo antes posibles para poder cumplir lo dispuesto.";

 
        //  Mail::send('mail/Correo', $details, function ($message) use ($user_asig, $details) {
        //      $message->to($user_asig->email)->subject('Sistema de Gestión de Documental');
        //  });
 
 
        //  //user mail
        //  $user = User::where('users.id', $tasks->user_id)->first();
        //  //nombre del usuario que asigna
        //  $user_asignado = User::where('users.id', $tasks->user_asig_id)->first();

        //  $tasks = Tasks::where('tasks.id', $tasks->id)->first();

        //  $details["user"] = $user->name;
 
        //  $details["inicio"] = "Usted asigno una tarea:  " .$tasks->name. " para el usuario: ".$user_asignado->name;
 
        //  Mail::send('mail/Correo', $details, function ($message) use ($user, $details) {
        //      $message->to($user->email)->subject('Sistema de Gestión de Documental');
        //  });

        return $this->sendResponse(new TasksResource($tasks), 'Tarea Creada Correctamente.');
    }

    
    public function show($id)
    {
        $tasks = Tasks::find($id);

        if (is_null($tasks)) {
            return $this->sendError('Tarea no encontrada.');
        }

        return $this->sendResponse(new TasksResource($tasks), 'Datos de Tarea recuperados correctamente.');
    }

    public function update(Request $request, $id)
    {
        $tasks = Tasks::find($id);
        $tasks->name = $request->input('name');
        $tasks->description = $request->input('description');
        $tasks->date = $request->input('date');
        $tasks->user_id = $request->input('user_id');
        $tasks->user_asig_id = $request->input('user_asig_id');
        $tasks->process_id = $request->input('process_id');
        $tasks->file_id = $request->input('file_id');
        $tasks->status = $request->input('status');
        $tasks->save();

        return $this->sendResponse(new TasksResource($tasks), 'Tarea Editada Correctamente.');
    }

    public function destroy($id)
    {
        $tasks = Tasks::find($id);
        $tasks->delete();

        return $this->sendResponse([], 'Tarea Eliminada Correctamente.');
    }


    public function tasksUser($id, $date)
    {
        $tasks = Tasks::where('user_asig_id', $id)
        ->where('date', 'like', '%' . $date . '%')
        ->orderBy('created_at', 'desc') 
        ->get();
        return $this->sendResponse(TasksResource::collection($tasks), 'Tareas de Usuario Asignado Recuperadas Correctamente.');
    }

    public function tasksUpdateStatus(Request $request, $id)
    {
        $tasks = Tasks::find($id);
        $tasks->status = $request->input('status');
        $tasks->save();

        return $this->sendResponse(new TasksResource($tasks), 'Estado Editado Correctamente.');
    }

    public function tasksUserlast($user_id)
    {
        $tasks = Tasks::where('user_id', $user_id)
        ->where('status', 'A')
        ->orderBy('created_at', 'asc')
        ->take(1)
        ->get();
        return $this->sendResponse(TasksResource::collection($tasks), 'Tareas de Usuario Asignado Recuperadas Correctamente.');
    }
}
