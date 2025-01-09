<?php

namespace App\Http\Controllers;

use App\Models\LevelConf;
use Illuminate\Http\Request;

Class LevelConfirmation extends Controller{



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
        
        
        $rq = LevelConf::getStudentConf();
        

        return view('levelconfirmation', compact('rq'));
    }

    public function accept(Request $request){
        $id = $request->input('id');
        LevelConf::acceptForm($id);
        return $this->show();
    }

}
