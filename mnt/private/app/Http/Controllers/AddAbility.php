<?php

namespace App\Http\Controllers;

Class AddAbility extends Controller{

    public function show(){
        session_start();
        require_once('../resources/includes/header.php');
        require_once('../resources/includes/navbar/navbar_admin.php');
        return view('addability');
    }

}
