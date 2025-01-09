<?php

/**
 * SkillsDetails Controller
 * 
 * This controller handles the display of skill details for a user.
 * 
 * @package App\Http\Controllers
 */

 namespace App\Http\Controllers;

 use App\Models\Uti;
 use Illuminate\Support\Facades\DB;
 
 /**
  * Class SkillsDetails
  * 
  * This class contains methods to display skill details for a user.
  */
Class SkillsDetails extends Controller{
    /**
      * Show the skill details for the logged-in user.
      * 
      * This method checks if the user is logged in and has an active session.
      * It then retrieves the user's details, active formations, skills, competencies,
      * and courses, and passes them to the 'skillsdetails' view.
      * 
      * @return \Illuminate\View\View The view displaying the skill details.
      */
    public function show(){
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

        $me=Uti::find($_SESSION['id']);


        $req = "select for_id from APPRENDRE where uti_id = ?";
        $param = [$_SESSION['id']];
        foreach($_SESSION['active_formations'] as $training){
            $req .= " and for_id = ?";
            $param[] = $training->FOR_ID;
        }
        $idTraining = DB::select($req, $param)[0]->for_id;

        $formation = [];

        foreach($_SESSION['active_formations'] as $training){
            //dd($training, $idTraining);
           // print_r()
            if($training->FOR_ID == $idTraining){
                
                $formation = $training;
            }
        }

        $me = Uti::find($_SESSION["id"]); 

        $listSkills = DB::select("select apt_id, apt_libelle from APTITUDE join COMPETENCE using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);

        $listCompetence = DB::select("select com_id, com_libelle ,count(*) as nb from APTITUDE join COMPETENCE using(com_id) where niv_id = ?  group by com_id, com_libelle order by com_id",[$formation->NIV_ID]);

        $listCours = DB::select("select distinct cou_date from COURS join MAITRISER using (cou_id) join UTILISATEUR using (uti_id) where uti_id = ? and for_id = ? order by cou_date", [$_SESSION["id"], $formation->FOR_ID]);
        
        $tab = [];
        foreach ($listSkills as $skill){
            $tab[] = DB::select("select mai_progress, cou_date from MAITRISER join COURS using(cou_id) where apt_id = ? and uti_id = ?", [$skill->apt_id,$_SESSION['id']]);
        }

        //echo"<pre>";
        //print_r($tab);
        //echo"</pre>";


        return view('skillsdetails', ['formation' => $formation, 'listSkills' => $listSkills, 'listCompetence' => $listCompetence, 'listCours'=> $listCours, 'tab' => $tab , 'me' => $me]);
    }

}
 
     