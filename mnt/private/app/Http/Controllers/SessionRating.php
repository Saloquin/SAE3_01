<?php
/**
 * Class SessionRating
 * 
 * This controller handles the session rating functionalities, including displaying session details and updating student skills for a session.
 * 
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uti;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

Class SessionRating extends Controller{
    /**
     * Show the session rating page.
     * 
     * This method displays the session rating page based on the session ID provided in the request. It checks if the user is logged in and has the necessary permissions. It also verifies the session date and previous progress of the students before displaying the session details.
     * 
     * @param Request $request The HTTP request object containing the session ID.
     * @return \Illuminate\View\View The view for the session rating page.
     */
    public function show(Request $request) {
        session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        include resource_path('includes/header.php');
        if(isset($_SESSION['director'])){ include resource_path('includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ include resource_path('includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ include resource_path('includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ include resource_path('includes/navbar/navbar_student.php'); }

        $sessionId = $request->input('cou_id');

        if (!$sessionId) {
            return view('valider_aptitudes', ['sessionId' => -1]);
        }

        $session = Lesson::getSessionById($sessionId);
        
        if ($session->COU_DATE > date('Y-m-d')) {
            return view('valider_aptitudes', ['sessionId' => -2]);
        }
        
        $allOldProgress = DB::select(" select mai_progress from COURS
                                    join groupe using(cou_id)
                                    join maitriser on groupe.cou_id = maitriser.cou_id and groupe.uti_id_elv1 = maitriser.uti_id
                                    where cou_date < ? and uti_id_init = ?
                                    union
                                    select mai_progress from cours
                                    join groupe using(cou_id)
                                    join maitriser on groupe.cou_id = maitriser.cou_id and groupe.uti_id_elv2 = maitriser.uti_id
                                    where cou_date < ? and uti_id_init = ?", [$session->COU_DATE, $_SESSION['id'], $session->COU_DATE, $_SESSION['id']]);

        foreach ($allOldProgress as $oldProgress) {
            if ($oldProgress->mai_progress == 'non évaluée' || $oldProgress->mai_progress == 'Non évaluée' || $oldProgress->mai_progress == 'non évalué' || $oldProgress->mai_progress == 'Non évalué') {
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
    /**
     * Update student skills for a session.
     * 
     * This method updates the skills of students for a specific session based on the input provided in the request. It iterates through the skills of each student and updates their progress and comments.
     * 
     * @param Request $request The HTTP request object containing the session ID, student IDs, and their respective skills and comments.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the initiator page with a success message.
     */
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