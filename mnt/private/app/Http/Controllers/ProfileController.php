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

class ProfileController extends Controller
{

    public function index()
    {
        $clubId = 1;
        $students = Uti::getStudent()->where('CLU_ID', $clubId);
        $teachers = Uti::getTeacher()->where('CLU_ID', $clubId);
        $levels = Level::whereNotNull('NIV_DESCRIPTION')->get();
        $formations = Formation::with(['level', 'club'])->where('CLU_ID', $clubId)->get();


        // Retourner la vue avec les données
        return view('profile', compact('students', 'teachers', 'formations','clubId','levels'));
    }


    public function insertStudent(Request $request)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:utilisateur,UTI_ID',
            'formation' => 'required|exists:formation,FOR_ID',
        ]);

        foreach ($request->students as $studentId) {
            $existingAssociation = Learn::where('UTI_ID', $studentId)
                                        ->where('FOR_ID', $request->formation)
                                        ->first();

            if ($existingAssociation) {
                continue;
            }

            Learn::create([
                'UTI_ID' => $studentId,
                'FOR_ID' => $request->formation,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Les étudiants ont été ajoutés à la formation.');
    }


    public function insertTeacher(Request $request)
    {
        
        $request->validate([
            'teachers' => 'required|array',
            'teachers.*' => 'exists:utilisateur,UTI_ID',
            'formation' => 'required|exists:formation,FOR_ID',
        ]);

        
        foreach ($request->teachers as $teacherId) {
            $existingAssociation = Teach::where('UTI_ID', $teacherId)
                                        ->where('FOR_ID', $request->formation)
                                        ->first();

            if ($existingAssociation) {
                continue;
            }
            Teach::create([
                'UTI_ID' => $teacherId,
                'FOR_ID' => $request->formation,
            ]);
        }

    
        return redirect()->route('profile')->with('success', 'Les enseignants ont été ajoutés à la formation.');
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

        return redirect()->route('profile')->with('success', 'Le responsable de la formation a été modifié.');

    }

    public function insertUser(Request $request)
    {
        
        $validated = $request->validate([
            'UTI_NOM' => 'required|string|max:255',
            'UTI_PRENOM' => 'required|string|max:255',
            'UTI_MAIL' => 'required|email|unique:utilisateur,UTI_MAIL|max:255',  
            'lvl' => 'required|exists:niveau,NIV_ID',  
            'init' => 'required|boolean',  
            'clubId' => 'required|exists:club,CLU_ID' 
        ]);
        
        if ($validated['lvl'] < 2 && $validated['init'] == 1) {
            return redirect()->route('profile')->with('failed', "L'utilisateur ne peut pas être un initiateur si son niveau est inférieur à 2.");

        }

        $password = Str::random(8);
        
        Uti::create([
            'UTI_NOM' => $validated['UTI_NOM'],
            'UTI_PRENOM' => $validated['UTI_PRENOM'],
            'UTI_MAIL' => $validated['UTI_MAIL'],
            'NIV_ID' => $validated['lvl'], 
            'UTI_EST_INIT' => $validated['init'],  
            'CLU_ID' => $validated['clubId'],  
            'UTI_MDP' => $password, 
        ]);
        
        Mail::to($validated['UTI_MAIL'])->send(new UserCreatedMail([
            'name' => $validated['UTI_PRENOM'] . ' ' . $validated['UTI_NOM'],
            'email' => $validated['UTI_MAIL'],
            'password' => $password,
        ]));
        
        return redirect()->route('profile')->with('success', "L'utilisateur a été créé. son mot de passe est ".$password);
    }

    

       
}
