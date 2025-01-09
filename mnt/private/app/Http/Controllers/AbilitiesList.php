<?php

namespace App\Http\Controllers;

Class AbilitiesList extends Controller{

    public function show(){
        session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        require_once('../resources/includes/header.php');
        require_once('../resources/includes/navbar/navbar_admin.php');
        return view('abilitieslist');
    }

}
