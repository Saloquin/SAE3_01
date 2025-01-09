<?php

namespace App\Http\Controllers;

use App\Models\Uti;

Class Trainee extends Controller{

    public function show(){
        session_start();
        $user = Uti::find($_SESSION["id"]);
        return view('trainee', compact('user'));
    }

}