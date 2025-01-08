<?php

namespace App\Http\Controllers;

use App\Models\ttInitiatorModel;
use Illuminate\Support\Facades\DB;
use App\Models\Uti;


use Illuminate\Http\Request;

class ttInitiatorController extends Controller
{

    function show($days,$data){
        return view('ttInitiatorView', compact('days'), compact('data'));
    }

    function tt(){
        //var_dump(Uti::getInitiatorById(2));
        $tt = ttInitiatorModel::getCoursById(2);
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
            $i += 1;
        }
        return $this->show($arr,$arr2);
    }

}
