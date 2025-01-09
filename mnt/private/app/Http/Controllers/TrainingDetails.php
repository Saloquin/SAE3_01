<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Formation;
use App\Models\trainingInf;

Class TrainingDetails extends Controller{

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
        $students = trainingInf::getStudentByFor($_SESSION['active_formations'][0]->NIV_ID);
        $initiators = trainingInf::getInitiatorByFor($_SESSION['active_formations'][0]->NIV_ID);
        return view('trainingdetails', compact('students'), compact('initiators'));

    }

}
