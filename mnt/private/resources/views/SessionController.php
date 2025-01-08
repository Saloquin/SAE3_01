<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Skill;
use App\Models\Uti;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession()
    {
        $skills = Skill::getSkillByFormationLevel();
        $students = Uti::getStudent();
        $initiators = Uti::getTeacher();
        
        return view('CreateSession', ['skills' => $skills, 'student' => $students, 'initiator' => $initiators]);
    }

    public function executeRequest(Request $request)
    {
        $studentIds = $request->input('student');
        $initiatorIds = $request->input('initiator');
        $competences = $request->input('competences');
        $date = $request->input('date');
    
        if (empty($studentIds) || empty($initiatorIds) || empty($competences) || empty($date)) {
            return redirect()->back()->with('error', 'Tous les champs doivent être remplis.');
        }
    
        if (count($studentIds) > count($initiatorIds) * 2) {
            return redirect()->back()->with('error', "Il ne peut y avoir que deux élèves maximum par initiateur.");
        }
    
        $for_id = 1;
        $teacherIndex = 0;
    
        for ($i = 0; $i < count($studentIds); $i += 2) {
            $studentId1 = $studentIds[$i];
            $studentId2 = $studentIds[$i + 1] ?? null;
            $initiatorId = $initiatorIds[$teacherIndex];
            
            $aptitudes1 = $competences[$studentId1] ?? [];
            $aptitudes2 = $studentId2 ? ($competences[$studentId2] ?? []) : [];
            var_dump($studentId1);
            var_dump($aptitudes1);
            var_dump($studentId1);
            var_dump($aptitudes2);
    
            Lesson::insertLesson($for_id, $date, $studentId1, $studentId2, $initiatorId, $aptitudes1, $aptitudes2);
    
            if (($i / 2 + 1) % 2 == 0) {
                $teacherIndex++;
            }
        }
    
        return redirect('/')->with('success', 'La session a été créée avec succès.');
    }
    
}
