<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uti;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

Class SessionRating extends Controller{

    public function show(Request $request) {
        session_start();

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        $sessionId = $request->input('cou_id');

        if (!$sessionId) {
            return view('valider_aptitudes', ['sessionId' => -1]);
        }

        $session = Lesson::getSessionById($sessionId);
        
        if ($session->COU_DATE > date('Y-m-d')) {
            return view('valider_aptitudes', ['sessionId' => -2]);
        }
        
        $allOldProgress = DB::select(" select mai_progress from COURS
                                    join GROUPE using(cou_id)
                                    join MAITRISER on GROUPE.cou_id = MAITRISER.cou_id and GROUPE.uti_id_elv1 = MAITRISER.uti_id
                                    where cou_date < ? and uti_id_init = ?
                                    union
                                    select mai_progress from COURS
                                    join GROUPE using(cou_id)
                                    join MAITRISER on GROUPE.cou_id = MAITRISER.cou_id and GROUPE.uti_id_elv2 = MAITRISER.uti_id
                                    where cou_date < ? and uti_id_init = ?", [$session->COU_DATE, $_SESSION['id'], $session->COU_DATE, $_SESSION['id']]);

        foreach ($allOldProgress as $oldProgress) {
            if ($oldProgress->mai_progress == 'non évaluée' || $oldProgress->mai_progress == 'Non évaluée') {
                return view('valider_aptitudes', ['sessionId' => -3]);
            }
        }

        $studentsIds = Lesson::getStudentsOfInitiatorAtSession($sessionId, $_SESSION['id']);
        $studentId1 = $studentsIds[0];
        $studentId2 = $studentsIds[1];
        $student1 = Uti::getStudentById($studentId1);
        $student2 = Uti::getStudentById($studentId2);
        $skills1 = Lesson::getStudentSkillsAtSession($sessionId, $studentId1);
        $skills2 = Lesson::getStudentSkillsAtSession($sessionId, $studentId2);

        return view('valider_aptitudes', ['sessionId' => $sessionId, 'session' => $session, 'studentId1' => $studentId1, 'studentId2' => $studentId2,
                                          'student1' => $student1, 'student2' => $student2, 'skills1' => $skills1, 'skills2' => $skills2]);
    }

    public function updateStudentSkillForSession(Request $request) {
        $sessionId = $request->input('sessionId');
        $studentId1 = $request->input('studentId1');
        $studentId2 = $request->input('studentId2');
        $skills1 = $request->input('skills1');
        $skills2 = $request->input('skills2');

        foreach ($skills1 as $skill) {
            $mai_progress = $request->input('mai_progress_student1_apt_' . $skill);
            $mai_commentaire = $request->input('commentary_student1_apt_' . $skill);

            Lesson::updateStudentSkillsAtSession($sessionId, $studentId1, $skill, $mai_progress, $mai_commentaire);
        }

        if ($studentId2) {
            foreach ($skills2 as $skill) {
                $mai_progress = $request->input('mai_progress_student2_apt_' . $skill);
                $mai_commentaire = $request->input('commentary_student2_apt_' . $skill);

                Lesson::updateStudentSkillsAtSession($sessionId, $studentId2, $skill, $mai_progress, $mai_commentaire);
            }
        }

        return redirect('/initiateur')->with('success', 'Les aptitudes ont été modifiées avec succès.');;
    }

}
