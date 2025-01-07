<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Uti;
use App\Models\Formation;
use App\Models\Learn;
use App\Models\Teach;

class ProfileController extends Controller
{

    public function index()
{
    $clubId = 1;
    $students = Uti::getStudent()->where('CLU_ID', $clubId);
    $teachers = Uti::getTeacher()->where('CLU_ID', $clubId);

    $formations = Formation::with(['level', 'club'])->where('CLU_ID', $clubId)->get();


    // Retourner la vue avec les données
    return view('profile', compact('students', 'teachers', 'formations'));
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



}
