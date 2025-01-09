<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

Class SkillsManagement extends Controller{

    public function show() {

       session_start();
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
        
        $listSkills = DB::select("select apt_id, apt_libelle from APTITUDE join COMPETENCE using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);

        $listCompetence = DB::select("select com_id, com_libelle, count(*) as nb from APTITUDE join COMPETENCE using(com_id) where niv_id = ? group by com_id, com_libelle order by com_id", [$formation->NIV_ID]);

        $listTrainee = DB::select("select uti_id, concat(uti_nom, ' ', uti_prenom) as nom from APPRENDRE join UTILISATEUR using (uti_id) where for_id = ? order by uti_id", [$formation->FOR_ID]);

        $tab = [];
        
        foreach ($listSkills as $skill){
            $tab[] = DB::select("select val_statut from VALIDER where apt_id = ? and uti_id in ( select uti_id from APPRENDRE where for_id = ? ) order by uti_id", [$skill->apt_id, $formation->FOR_ID]);
        }

        return view('skillsmanagement', ['formation' => $formation, 'listSkills' => $listSkills, 'listCompetence' => $listCompetence, 'listTrainee' => $listTrainee, 'tab' => $tab]);
    }

}
