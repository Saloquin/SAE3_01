<?php

namespace App\Http\Controllers;

use App\Models\ttModel;
use Illuminate\Support\Facades\DB;
use App\Models\Uti;
use Illuminate\Http\Request;


class Initiator extends Controller
{

    function show(){
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

        //var_dump(Uti::getInitiatorById(2));
        $tt = ttModel::getSessionInitiatorById($_SESSION['id']);
        $arr = [];
        $arr2 = [];
        $i = 0;
        foreach ($tt as $row){
            array_push($arr2, []);
            array_push($arr, $row->cou_date);
            array_push($arr2[$i], $row->cou_date);
            array_push($arr2[$i], $row->uti_id_elv1);
            array_push($arr2[$i], $row->uti_id_elv2);
            array_push($arr2[$i], $row->uti_nom);
            array_push($arr2[$i], $row->uti_prenom);
            array_push($arr2[$i], $row->uti_nom2);
            array_push($arr2[$i], $row->uti_prenom2);
            array_push($arr2[$i], $row->niv);
            array_push($arr2[$i], $row->cou_id);
            $i += 1;
        }
        return view('initiator', compact('arr'), compact('arr2'));
    }

}
