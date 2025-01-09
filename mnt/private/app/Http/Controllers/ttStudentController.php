<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ttModel;

session_start();

class ttStudentController extends Controller
{
    function show(){
        //var_dump(Uti::getInitiatorById(2));
        include resource_path('includes/header.php');
        if(isset($_SESSION['director'])){ include resource_path('includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ include resource_path('includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ include resource_path('includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ include resource_path('includes/navbar/navbar_student.php'); }
        $tt = ttModel::getSessionStudentById($_SESSION['id']);
        $arr = [];
        foreach ($tt as $row){
            array_push($arr, $row->apt_libelle);
            array_push($arr, $row->cou_date);
        }
        return view('ttStudentView', compact('arr'));
    }
}
