<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PruebaController extends Controller
{
    public function index(Request $request)
    {
        //$response = Http::post('http://192.168.1.135:8080/api-firma-ec/APIREST/Firmarpdf');
        $response = Http::post('http://localhost:8080/api-firma-ec/APIREST/Firmarpdf', [ //http://localhost:8080/api-firma-ec/APIREST/Firmarpdf
            'documentopdf' => $request->input('documentopdf'),
            'archivop12' => $request->input('archivop12'),
            'contrasena' => $request->input('contrasena'),
            'pagina' => $request->input('pagina'),
            'h' => $request->input('h'),
            'v' => $request->input('v'),
        ]);

        return $response;

        // $datos =  json_decode($response, true);
        // $data = $datos['docFirmado'];
        // $arr2 = stripslashes($data);
        // $result = preg_replace('/C:UsersRicardoDesktopapi_documentalpublicstorage|de los/m',"", $arr2);
        // $filename = explode(" ", $result);
        // $file = Storage::disk('public')->get($result);
        // $date = date('dmY_His');
        // $new_filename = $date. '_' .$request->input('name'). '.' . $request->input('extension');
        // $enviar = Storage::disk('ftp')->put($new_filename, $file);

        // Storage::disk('public')->delete($result);
        // return $new_filename;

    }



    public function SendMensaje(Request $request)
    {
        $user = User::where('users.id', $request->get('notificado'))->first();


        $subject = $request->get('subject');

        Mail::send('mail/email',
            array(
                'user_message' => $request->get('message'),
            )
            , function ($message) use ($user, $subject) {
                $message->to($user->email)->subject($subject);
            });
            

    }

    public function file($filename)
    {
        $date = date('dmY_His');
        $file = Storage::disk('ftp')->get($filename);
        $new_filename= 'temporal.pdf';
        
        $enviar = Storage::disk('public')->put($new_filename, $file);
        return $enviar;
    }


}
