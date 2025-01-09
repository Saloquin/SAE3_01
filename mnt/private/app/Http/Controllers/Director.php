<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Formation;
use Illuminate\Http\Request;

Class Director extends Controller{

    public function show(){
        session_start();

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $me = Uti::find($_SESSION["id"]);
        $init = Uti::getTeacher();
        $formations = Formation::with(['level', 'club'])->where('CLU_ID', $clubId)->get();
        return view('director', compact('formations' ,'clubId','init','me'));
    }

    public function editREsponsable(Request $request){
        $request->validate([
            'formation' => 'required|exists:FORMATION,FOR_ID',
            'responsable' => 'required|exists:UTILISATEUR,UTI_ID',
        ]);

        $formation = Formation::find($request->formation);
        $formation->UTI_ID = $request->responsable;
        $formation->save();
        return redirect()->route('directeur');
    }

}
