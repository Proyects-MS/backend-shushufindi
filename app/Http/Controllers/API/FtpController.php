<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FtpController extends Controller
{
    public function store(Request $request)
    {

        if ($request->hasFile('file')) {
            $date = date('dmY_His');
            $filenamewithextension = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenametostore = $date . '_' . $filename . '.' . $extension;
            $response = Storage::disk('ftp')->put($filenametostore, fopen($request->file('file'), 'r+'));
            return ['filename' => $filenametostore];
        } else {
            return false;
        }
    }

    public function show($filename)
    {
        if ($filename !== '') {
            return Storage::disk('ftp')->get($filename);
        } else {
            return false;
        }

    }
  

    public function firmas(Request $request)
    {
        if ($request->hasFile('signature')) {
            $date = date('dmY_His');
            $filenamewithextension = $request->file('signature')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('signature')->getClientOriginalExtension();
            $filenametostore = $date . '_' . $filename . '.' . $extension;
            $response = Storage::disk('public')->put($filenametostore, fopen($request->file('signature'), 'r+'));
            return ['filename' => $filenametostore];
        } else {
            return false;
        }
    }
}
