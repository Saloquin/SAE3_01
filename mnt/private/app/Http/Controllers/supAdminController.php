<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class supAdminController extends Controller
{
    public function show(){
        return view('supAdminView');
    } 
}
