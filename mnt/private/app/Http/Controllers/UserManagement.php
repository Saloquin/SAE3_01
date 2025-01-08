<?php
namespace App\Http\Controllers;

use App\Models\Uti;
Class UserManagement extends Controller{

    public function show(){
        session_start();
        $clubId = Uti::find($_SESSION["id"])->CLU_ID;
        $users = Uti::where('CLU_ID', $clubId)->get();
        return view('usermanagement', compact('users'));
    }

}