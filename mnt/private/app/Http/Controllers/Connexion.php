<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Connexion extends Controller
{
    public function show(){

        session_start();
        session_unset();
        if(isset($_SESSION['id'])){
            $this->redirect();
        }
        return view('connexion');
    }

    private function redirect(){
        if(DB::select('select count(*) as nb from CLUB where uti_id = ?',[$_SESSION['id']])[0]->nb){
            header('location: director_panel');
            exit;
        }
        foreach ($_SESSION['active_formations'] as $formation) {
            if($formation->UTI_ID == $_SESSION['id']){
                echo 'rf';

                exit;
                // rediriger vers panel rf
            }

            $res = DB::select('select count(*) as nb from initier where for_id = ? and uti_id = ?',[$formation->FOR_ID,$_SESSION['id']]);
            if($res[0]->nb){
                echo 'initiateur';
                exit;
                // rediriger vers panel initier
            }
            $res = DB::select('select count(*) as nb from apprendre where for_id = ? and uti_id = ?',[$formation->FOR_ID,$_SESSION['id']]);
            if($res[0]->nb){
                echo 'eleve';
                exit;
                // rediriger vers panel élève
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
            $res = DB::select('select * from UTILISATEUR where uti_id = ? and uti_mdp = ?',[$licence,$password]);
            if(isset($res[0])){
                $_SESSION['active_formations'] = DB::select('select * from FORMATION where clu_id = ? and datediff(sysdate(), for_annee) between 0 and 365.25', [$res[0]->CLU_ID]);
                $_SESSION['id'] = $res[0]->UTI_ID;
                $this->redirect();
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
