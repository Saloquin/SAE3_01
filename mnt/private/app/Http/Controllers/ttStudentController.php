<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ttModel;



class ttStudentController extends Controller
{
    function show(){
        //var_dump(Uti::getInitiatorById(2));
        include resource_path('includes/header.php');
        
        $tt = ttModel::getSessionStudentById($_SESSION['id']);
        $arr = [];
        foreach ($tt as $row){
            array_push($arr, $row->apt_libelle);
            array_push($arr, $row->cou_date);
        }
        return view('ttStudentView', compact('arr'));
    }
}
