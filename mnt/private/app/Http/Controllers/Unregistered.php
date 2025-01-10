<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

Class Unregistered extends Controller{

    public function show() {

        session_start();

        // Checks whether the user is connected
        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        // Adds the header
        require_once('../resources/includes/header.php');

        return view('unregistered');
    }

}
