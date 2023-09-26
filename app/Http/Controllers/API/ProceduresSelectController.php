<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProcessType;
use App\Models\Hiring;
use App\Models\Procedure;

class ProceduresSelectController extends Controller
{
    public function searchProcessType(){
        $processType = ProcessType::all();
        return response()->json($processType);
    }

    public function searchHiring($id_processType){
        $hiring = Hiring::where('id_processtype', $id_processType)->get();
        return response()->json($hiring);
    }

    public function searchProcedure($id_hiring){
        $procedure = Procedure::where('id_hiring', $id_hiring)->get();
        return response()->json($procedure);
    }
}
