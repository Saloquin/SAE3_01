<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Skill;
use App\Models\Uti;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index() {
        $skill = Skill::getSkillByFormationLevel();
        $student = Uti::getStudent();
        $initiator = Uti::getTeacher();
        return view('CreateSession', ['skills' => $skill, 'student' => $student, 'initiator' => $initiator]);
    }

    public function executeRequest(Request $request) {
        $studentId = $request->input('student');
        print_r($studentId);
        $teacherId = $request->input('teacher');
        $competenceId = $request->input('competence');
    
        if (empty($studentId) || empty($teacherId) || empty($competenceId)) {
            return redirect()->back()->with('error', 'Tous les champs doivent être remplis.');
        }
    
        $cou_date = now();
        $for_id = 1;
        
        Session::insertSession($for_id, $cou_date, $studentId[0], $studentId[1] ?? null, $teacherId[0]);
    
        //return redirect('/')->with('success', 'La session a été créée avec succès.');
    }
    
    
}
