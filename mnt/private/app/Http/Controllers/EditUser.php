<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use Illuminate\Http\Request;

Class EditUser extends Controller{

    public function show(Request $request){
        $users = Uti::find($request->input('UTI_ID'));
        return view('edituser', compact('users'));
    }

}