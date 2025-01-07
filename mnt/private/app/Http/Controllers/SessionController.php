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
        $teacherId = $request->input('teacher');
        $competenceId = $request->input('competence');
    
        if (empty($studentId) || empty($teacherId) || empty($competenceId)) {
            return redirect()->back()->with('error', 'Tous les champs doivent être remplis.');
        }
    
        if (count($studentId) > count($teacherId) * 2) {
            return redirect()->back()->with('error', "Il ne peut y avoir que deux élèves maximum par initiateur.");
        }
        
        $cou_date = now();
        $for_id = 1;
        
        for ($i = 0; $i < count($studentId); $i++) {
            $studentId1 = $studentId[$i];
            $studentId2 = $studentId[$i + 1] ?? null;
            $initiatorId = $teacherId[intdiv($i, 2)];

            Session::insertSession($for_id, $cou_date, $studentId1, $studentId2, $initiatorId);

            $i++;
        }
    
        return redirect('/')->with('success', 'La session a été créée avec succès.');

        // GÉRER APTITUDES
    }
    
    
}
