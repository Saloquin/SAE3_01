<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use Illuminate\Http\Request;

Class EditUser extends Controller{

    public function show(Request $request){
        session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        $users = Uti::find($request->input('UTI_ID'));
        return view('edituser', compact('users'));
    }

}
