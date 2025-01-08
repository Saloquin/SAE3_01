<?php

namespace App\Http\Controllers;

use App\Models\Uti;

Class Profile extends Controller{

    public function show(){
        session_start();
        $user = Uti::find($_SESSION["id"]);
        return view('profile', compact('user'));
    }
    public function logout(){
        session_start();
        session_destroy();
        return redirect('');
    }

}