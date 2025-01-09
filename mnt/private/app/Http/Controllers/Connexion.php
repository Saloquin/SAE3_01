<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Class Connexion extends Controller{

    public function show(){
        session_start();
        session_unset();
        if(isset($_SESSION['id'])){
            if($_SESSION['id'] == 0){
                header('Location: superadmin');
                exit;
            }
            $this->redirect();
        }
        return view('connexion');
    }

    private function redirect(){
        if(DB::select('select count(*) as nb from CLUB where uti_id = ?',[$_SESSION['id']])[0]->nb){
            $_SESSION['director'] = true;
            header('location: directeur');
            exit;
        }
        foreach ($_SESSION['active_formations'] as $formation) {
            if($formation->UTI_ID == $_SESSION['id']){
                $_SESSION['manager'] = true;
                $_SESSION['formation_level'] = $formation->NIV_ID;
                header('Location: responsable-formation');
                exit;
                // redirect to training manageur home
            }

            $res = DB::select('select count(*) as nb from INITIER where for_id = ? and uti_id = ?',[$formation->FOR_ID,$_SESSION['id']]);
            if($res[0]->nb){
                $_SESSION['teacher'] = true;
                header('Location: initiateur');
                exit;
                // redirect to initiator home
            }
            $res = DB::select('select count(*) as nb from APPRENDRE where for_id = ? and uti_id = ?',[$formation->FOR_ID,$_SESSION['id']]);
            if($res[0]->nb){
                $_SESSION['student'] = true;
                header('Location: eleve');
                exit;
                // redirect to student home
            }
        }
        // renvoyer vers page pas de formation
        echo 'pas de formation';
        exit;
    }

    public function login(Request $request){
        session_start();

        $licence = $request->input('licence');
        $password = $request->input('password');
        if(isset($licence) && isset($password)){
            $res = DB::select('select * from UTILISATEUR where uti_id = ? and uti_mdp = ?',[$licence,md5($password)]);
            if($licence == 0){
                $_SESSION['id'] = $res[0]->UTI_ID;
                header('Location: superadmin');
                exit;
            }
            if(isset($res[0])){
                $_SESSION['active_formations'] = DB::select('select * from FORMATION where clu_id = ? and datediff(sysdate(), for_annee) between 0 and 365.25', [$res[0]->CLU_ID]);
                $_SESSION['id'] = $res[0]->UTI_ID;
                $this->redirect();
                exit;
            }
            // remettre page co avec msg d'erreur pas de compte
            echo 'pas de compte';
            exit;
        }
        // remettre page avec msg d'erreur pas rempli
        echo 'pas rempli';
        exit;
    }

}
