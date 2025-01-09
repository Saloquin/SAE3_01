<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ttModel;

session_start();

class Trainee extends Controller
{
    function show(){
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
