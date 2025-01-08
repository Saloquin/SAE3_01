<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ttModel;

session_start();

class Manager extends Controller
{
    function show(){
        $tt = ttModel::getCourseById($_SESSION['id']);
        $arr = [];
        $arr2 = [];
        $i = 0;
        foreach ($tt as $row){
            array_push($arr, $row->cou_id);
            array_push($arr, $row->cou_date);

        }
        return view('manager', compact('arr'));
    }
}
