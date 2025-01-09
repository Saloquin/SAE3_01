<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Skill;
use App\Models\Uti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SessionController extends Controller
{
    public function show(Request $request)
    {
        $date = $request->input('date');
        $course = null;
        $studentsData = []; 
        
        if ($date) {
            $course = Lesson::where('COU_DATE', $date)->first();
            
            if ($course) {
                $groups = DB::table('GROUPE')
                            ->where('COU_ID', $course->COU_ID)
                            ->get();

                foreach ($groups as $group) {
                    $student = Uti::find($group->UTI_ID_ELV1);
                    $initiator = Uti::find($group->UTI_ID_INIT);
                    
                    $aptitudes = DB::table('MAITRISER')
                                    ->where('COU_ID', $course->COU_ID)
                                    ->where('UTI_ID', $group->UTI_ID_ELV1)
                                    ->pluck('APT_ID');
                    
                    $studentsData[$group->UTI_ID_ELV1] = [
                        'student_name' => $student->UTI_NOM . ' ' . $student->UTI_PRENOM,
                        'initiator_name' => $initiator->UTI_NOM . ' ' . $initiator->UTI_PRENOM,
                        'aptitudes' => $aptitudes->toArray(),
                    ];
                }
            }
        }
        
        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'date' => $date,
                'students_data' => $studentsData
            ]);
        }

        $skills = Skill::getSkillByFormationLevel();
        $students = Uti::getStudent();
        $initiators = Uti::getTeacher();

        return view('CreateSession', [
            'skills' => $skills,
            'student' => $students,
            'initiator' => $initiators,
            'date' => $date,
            'course' => $course,
            'students_data' => $studentsData 
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
