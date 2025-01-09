<?php

namespace App\Http\Controllers;

use App\Models\LevelConf;
use Illuminate\Http\Request;

Class LevelConfirmation extends Controller{



    public function show(){
        $rq = LevelConf::getStudentConf();
        

        return view('levelconfirmation', compact('rq'));
    }

    public function accept(Request $request){
        $id = $request->input('id');
        LevelConf::acceptForm($id);
        return $this->show();
    }

}