<?php
/**
 * Class InitiatorController
 * 
 * This controller handles the display and update of student skills for a specific session.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Uti;
use App\Models\Lesson;

class InitiatorController extends Controller
{
     /**
      * Display the skills edition page for a specific session.
      *
      * @param Request $request The HTTP request instance.
      * @return \Illuminate\View\View|string The view for the skills edition page or an error message.
      */
    public function showSkillsEditionPage(Request $request) {
        $sessionId = $request->input('cou_id');

        if (!$sessionId) {
            return "Erreur : id de la séance non trouvé";
        }

        $session = Lesson::getSessionById($sessionId);
        $studentsIds = Lesson::getStudentsOfInitiatorAtSession($sessionId, $request->session()->get('id'));
        $studentId1 = $studentsIds[0];
        $studentId2 = $studentsIds[1];
        $student1 = Uti::find($studentId1);
        $student2 = Uti::find($studentId2);
        $skills1 = Lesson::getStudentSkillsAtSession($sessionId, $studentId1);
        $skills2 = Lesson::getStudentSkillsAtSession($sessionId, $studentId2);
        
        return view('valider_aptitudes', ['sessionId' => $sessionId, 'session' => $session, 'studentId1' => $studentId1, 'studentId2' => $studentId2,
                                          'student1' => $student1, 'student2' => $student2, 'skills1' => $skills1, 'skills2' => $skills2]);
    }
    /**
      * Update the skills of students for a specific session.
      *
      * @param Request $request The HTTP request instance.
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




 
 