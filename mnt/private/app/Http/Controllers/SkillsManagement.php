<?php
/**
 * Class SkillsManagement
 *
 * This controller handles the display of skills management page.
 * It ensures the user is authenticated and has the necessary session data.
 * It fetches and prepares data related to skills, competencies, and trainees for the view.
 *
 * @package App\Http\Controllers
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

Class SkillsManagement extends Controller{
    /**
     * Display the skills management page.
     *
     * This method starts the session, checks if the user is authenticated,
     * includes the appropriate navbar based on the user's role, and fetches
     * data related to the user's active formations, skills, competencies, and trainees.
     * The data is then passed to the 'skillsmanagement' view.
     *
     * @return \Illuminate\View\View
     */
    public function show() {

       session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        $formation = [];
        foreach ($_SESSION['active_formations'] as $formationSession) {
            if ($formationSession->UTI_ID == $_SESSION['id']) {
                $formation = $formationSession;
            }
        }

        $listSkills = DB::select("select apt_id, apt_libelle from aptitude join competence using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);

        $listCompetence = DB::select("select com_id, com_libelle, count(*) as nb from aptitude join competence using(com_id) where niv_id = ? group by com_id, com_libelle order by com_id", [$formation->NIV_ID]);

        $listTrainee = DB::select("select uti_id, concat(uti_nom, ' ', uti_prenom) as nom from apprendre join utilisateur using (uti_id) where for_id = ? order by uti_id", [$formation->FOR_ID]);

        $tab = [];

        foreach ($listSkills as $skill){
            $tab[] = DB::select("select val_statut from VALIDER where apt_id = ? and uti_id in ( select uti_id from apprendre where for_id = ? ) order by uti_id", [$skill->apt_id, $formation->FOR_ID]);
        }

        return view('skillsmanagement', ['formation' => $formation, 'listSkills' => $listSkills, 'listCompetence' => $listCompetence, 'listTrainee' => $listTrainee, 'tab' => $tab]);
    }

}
