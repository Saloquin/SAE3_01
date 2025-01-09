<?php

namespace App\Http\Controllers;

use App\Models\Uti;
Class UserManagement extends Controller{

    public function show(){
        session_start();

        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }

        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $users = Uti::where('CLU_ID', $clubId)->get();
        return view('usermanagement', compact('users'));
    }

}
