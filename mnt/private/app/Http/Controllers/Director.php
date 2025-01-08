<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Formation;

Class Director extends Controller{

    public function show(){
        session_start();
        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $uti = Uti::getTeacher()->where('CLU_ID',$clubId);
        $formations = Formation::with(['level', 'club'])->where('CLU_ID', $clubId)->get();
        return view('director', compact('formations' ,'clubId'));
    }

}