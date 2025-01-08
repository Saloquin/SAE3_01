<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Competence;

class addCompController extends Controller
{
    public function show(){
        $levels = Level::getLevels();
        //var_dump($levels);
        $lvls = [];
        foreach($levels as $row){
            $str = $row->niv_id . " : " . $row->niv_description;
            array_push($lvls, $str);
        }
        return view('addCompView', compact('lvls'));
    } 

    public function add(Request $request){
        $selection = $request->input('selection');
        $texte = $request->input('texte');
        Competence::addNew($selection,$texte);
        //dd($selection, $texte);
        return redirect()->route('superadmin');
        
        
    }
}
