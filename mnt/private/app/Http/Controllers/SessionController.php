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
        
        return view('CreateSession', [
            'skills' => $skills, 
            'student' => $students, 
            'initiator' => $initiators
        ]);
    }

    public function executeRequest(Request $request)
    {
        $studentIds = $request->input('student');
        $initiatorIds = $request->input('initiator');
        $competences = $request->input('competences');
        $date = $request->input('date');

        if (empty($studentIds) || empty($initiatorIds) || empty($competences) || empty($date)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Tous les champs doivent être remplis.');
        }

        if (count($studentIds) != count($initiatorIds)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Chaque élève doit être assigné à un initiateur.');
        }

        foreach ($studentIds as $studentId) {
            if (!isset($competences[$studentId]) || empty($competences[$studentId])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Chaque étudiant doit avoir des aptitudes.');
            }
        }

        $filteredInitiators = array_filter($initiatorIds, fn($value) => is_string($value) || is_int($value));
        $initiatorCounts = array_count_values($filteredInitiators);

        foreach ($initiatorCounts as $initiatorId => $count) {
            if ($count > 2) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "L'initiateur avec l'ID $initiatorId est assigné à plus de 2 étudiants.");
            }
        }

        $for_id = 1; 
        Lesson::insertLesson($for_id, $date);

        $usedStudents = []; 
        for ($i = 0; $i < count($studentIds); $i++) {
            if (in_array($studentIds[$i], $usedStudents)) {
                continue; 
            }

            $studentId1 = $studentIds[$i];
            $initiatorId = $initiatorIds[$i];
            $aptitudes1 = $competences[$studentId1] ?? [];

            $studentId2 = null;
            $aptitudes2 = [];

            for ($j = $i + 1; $j < count($studentIds); $j++) {
                if ($initiatorIds[$j] === $initiatorId && !in_array($studentIds[$j], $usedStudents)) {
                    $studentId2 = $studentIds[$j];
                    $aptitudes2 = $competences[$studentId2] ?? [];
                    $usedStudents[] = $studentId2; 
                    break;
                }
            }

            Lesson::insertGroup($studentId1, $studentId2, $initiatorId, $aptitudes1, $aptitudes2);

            $usedStudents[] = $studentId1;
        }

        return redirect('SessionManager/CreationSession')->with('success', 'La session a été créée avec succès.');
    }

}
