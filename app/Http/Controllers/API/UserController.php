<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{

    public function index()
    {
        $data = User::orderBy('name','ASC')->get();
        return $this->sendResponse(UserResource::collection($data), 'Usuarios Recuperados Correctamente.');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'identification_card' => 'required|unique:users,identification_card',
            // 'signature' => 'required|unique:users,signature',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $data = new User();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = bcrypt($request->input('password'));
        if ($request->file('profile_photo_path') == null) {
            $data->profile_photo_path = null;
        }else{
            $data->profile_photo_path = $request->file('profile_photo_path')->store('profile_image');
        }
        $data->signature = $request->input('signature');
        $data->signature_password = $request->input('signature_password');
        $data->identification_card = $request->input('identification_card');
        $data->role_id = $request->input('role_id');
        $data->status = $request->input('status');
        $data->position = $request->input('position');
        $data->save();

        // $user = User::where('users.id', $data->id)->first();
 
        // $details["inicio"] = "Su usuario ha sido creado correctamente";
 
        //  Mail::send('mail/Correo', $details, function ($message) use ($user, $details) {
        //      $message->to($user->email)->subject('Sistema de Gestión de Documental');
        //  });
        //return $request;
        return $this->sendResponse(new UserResource($data), 'Usuario Creado Correctamente.');
    }

    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('Usuario no encontrado.');
        }

        return $this->sendResponse(new UserResource($user), 'Datos de Usuario recuperados correctamente.');
    }


    public function update_user(Request $request, $id)
    {
        $data = User::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->role_id = $request->input('role_id');
        $data->position = $request->input('position');
        $data->save();

        // $user = User::where('users.id', $data->id)->first();
 
        // $details["inicio"] = 'Notificación: Usuario '.$user->name . ' su email ha sido cambiado a ' . $user->email;
 
        //  Mail::send('mail/Correo', $details, function ($message) use ($user, $details) {
        //      $message->to($user->email)->subject('Sistema de Gestión de Documental');
        //  });
        return $this->sendResponse(new UserResource($data), 'Usuario Editado Correctamente.');
    }

    public function update_password(Request $request, $id)
    {
        $data = User::find($id);
        $data->password = bcrypt($request->input('password'));
        $data->save();

        $user = User::where('users.id', $id)->first();
 
        $details["inicio"] = 'Notificación: Usuario '.$user->name. ' su contraseña ha sido cambiado a ' .$request->input('password');
 
         Mail::send('mail/Correo', $details, function ($message) use ($user, $details) {
             $message->to($user->email)->subject('Sistema de Gestión de Documental');
         });

        return $this->sendResponse(new UserResource($data), 'Contraseña Editada Correctamente.');
    }

    public function update_signature(Request $request, $id)
    {
        $data = User::find($id);
        $data->signature = $request->input('signature');
        $data->signature_password = $request->input('signature_password');
        $data->save();
        return $this->sendResponse(new UserResource($data), 'Firma Editada Correctamente.');
    }

    public function update_photo(Request $request, $id)
    {
        $data = User::find($id);
        if ($request->file('profile_photo_path') == null) {
            $data->profile_photo_path = null;
        }else{
            $data->profile_photo_path = $request->file('profile_photo_path')->store('profile_image');
        }       
        $data->save();
        return $this->sendResponse(new UserResource($data), 'Foto Editada Correctamente.');
    }

    public function update_status(Request $request, $id)
    {
        $data = User::find($id);
        $data->status = $request->input('status');
        $data->save();
        return $this->sendResponse(new UserResource($data), 'Estado Editado Correctamente.');
    }

    public function destroy($id)
    {
        //$data = User::find($id)->delete();
        //return $this->sendResponse([], 'Usuario eliminado correctamente.');
        $data = User::find($id);
        $data->status = 'I';
        $data->save();
        return $this->sendResponse(new UserResource($data), 'Estado Desactivado Correctamente.');
    }

    public function Activos()
    {
        $data = User::orderBy('name','ASC')->where('role_id', '!=' , 1)->where('status', 'A')->get();
        return $this->sendResponse(UserResource::collection($data), 'Usuarios Recuperados Correctamente.');
    }
}
