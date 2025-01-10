<?php

/**
 * SkillsDetails Controller
 * 
 * This controller handles the display of skill details for a user.
 * 
 * @package App\Http\Controllers
 */

 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
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
        

        

        include resource_path('includes/header.php');
        

        $me=Uti::find(session('id'));


        $req = "select for_id from apprendre where uti_id = ?";
        $param = [session('id')];
        foreach(session('active_formations') as $training){
            $req .= " or for_id = ?";
            $param[] = $training->FOR_ID;
        }
        $idTraining = DB::select($req, $param)[0]->for_id;

        $formation = [];

        foreach(session('active_formations') as $training){
            //dd($training, $idTraining);
           // print_r()
            if($training->FOR_ID == $idTraining){
                
                $formation = $training;
            }
        }

        $me = Uti::find(session('id')); 

        $listSkills = DB::select("select apt_id, apt_libelle from aptitude join competence using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);

        $listCompetence = DB::select("select com_id, com_libelle ,count(*) as nb from aptitude join competence using(com_id) where niv_id = ?  group by com_id, com_libelle order by com_id",[$formation->NIV_ID]);

        $listCours = DB::select("select distinct cou_date from cours join maitriser using (cou_id) join utilisateur using (uti_id) where uti_id = ? and for_id = ? order by cou_date", [session('id'), $formation->FOR_ID]);
        
        $tab = [];
        foreach ($listSkills as $skill){
            $tab[] = DB::select("select mai_progress, cou_date from maitriser join cours using(cou_id) where apt_id = ? and uti_id = ?", [$skill->apt_id,session('id')]);
        }

        //echo"<pre>";
        //print_r($tab);
        //echo"</pre>";


        return view('skillsdetails', ['formation' => $formation, 'listSkills' => $listSkills, 'listCompetence' => $listCompetence, 'listCours'=> $listCours, 'tab' => $tab , 'me' => $me]);
    }


    public function showTraineeSkills(Request $request){
        include resource_path('includes/header.php');
        
        $me = $request->route('userId');
        // $me=Uti::find(session('id'));


        $req = "select for_id from apprendre where uti_id = ?";
        $param = [$me];
        foreach(session('active_formations') as $training){
            $req .= " or for_id = ?";
            $param[] = $training->FOR_ID;
        }
        $idTraining = DB::select($req, $param)[0]->for_id;

        $formation = [];

        foreach(session('active_formations') as $training){
            //dd($training, $idTraining);
           // print_r()
            if($training->FOR_ID == $idTraining){
                
                $formation = $training;
            }
        }

        // $me = Uti::find(session('id')); 

        $listSkills = DB::select("select apt_id, apt_libelle from aptitude join competence using(com_id) where niv_id = ? order by com_id, apt_id", [$formation->NIV_ID]);

        $listCompetence = DB::select("select com_id, com_libelle ,count(*) as nb from aptitude join competence using(com_id) where niv_id = ?  group by com_id, com_libelle order by com_id",[$formation->NIV_ID]);

        $listCours = DB::select("select distinct cou_date from cours join maitriser using (cou_id) join utilisateur using (uti_id) where uti_id = ? and for_id = ? order by cou_date", [$me, $formation->FOR_ID]);
        
        $tab = [];
        foreach ($listSkills as $skill){
            $tab[] = DB::select("select mai_progress, cou_date from maitriser join cours using(cou_id) where apt_id = ? and uti_id = ?", [$skill->apt_id,$me]);
        }

        return view('skillsdetails', ['formation' => $formation, 'listSkills' => $listSkills, 'listCompetence' => $listCompetence, 'listCours'=> $listCours, 'tab' => $tab , 'me' => $me]);
    }

}
 
     