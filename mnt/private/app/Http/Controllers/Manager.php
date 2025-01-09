<?php

namespace App\Http\Controllers;

use App\Models\Uti;

Class Manager extends Controller{

    public function show(){
        session_start();
        $user = Uti::find($_SESSION["id"]);
        return view('manager', compact('user'));
    }

}