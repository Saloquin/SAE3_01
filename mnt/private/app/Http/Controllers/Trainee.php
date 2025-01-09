<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ttModel;

class Trainee extends Controller
{
    function show(){
        session_start();

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        //var_dump(Uti::getInitiatorById(2));
        $tt = ttModel::getSessionStudentById($_SESSION['id']);
        $arr = [];
        foreach ($tt as $row){
            array_push($arr, $row->apt_libelle);
            array_push($arr, $row->cou_date);
            array_push($arr, $row->uti_nom);
            array_push($arr, $row->uti_prenom);
            array_push($arr, $row->mai_progress);
        }
        // var_dump($tt);
        return view('trainee', compact('arr'));
    }
}
