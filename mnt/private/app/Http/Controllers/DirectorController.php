<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Uti;
use App\Models\Formation;
use App\Models\Learn;
use App\Models\Teach;
use App\Models\Level;
use App\Mail\UserCreatedMail;
use Illuminate\Support\Facades\Mail;

class DirectorController extends Controller
{

    public function index()
    {
        session_start();
        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $students = Uti::getStudent()->where('CLU_ID', $clubId);
        $teachers = Uti::getTeacher()->where('CLU_ID', $clubId);
        $levels = Level::whereNotNull('NIV_DESCRIPTION')->get();
        $formations = Formation::with(['level', 'club'])->where('CLU_ID', $clubId)->get();


        // Retourner la vue avec les données
        return view('director', compact('students', 'teachers', 'formations','clubId','levels'));
    }

    public function insertResponsable(Request $request)
    {
        $request->validate([
            'formation' => 'required|exists:formation,FOR_ID',
            'responsable' => 'required|exists:utilisateur,UTI_ID',
        ]);

        $formation = Formation::find($request->formation);
        $formation->UTI_ID = $request->responsable;
        $formation->save();

        return redirect()->route('director')->with('success', 'Le responsable de la formation a été modifié.');

    }
   
}
