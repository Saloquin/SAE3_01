<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Competence;

class addCompController extends Controller
{
    public function show(){
        

        

        include resource_path('includes/header.php');

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
        $selection = $request->input('selectionText');
        $text = $request->input('texte');
        preg_match('/^(\d+)/', $selection, $match);
        $lvl = $match[1];
        $success = Competence::addNew($lvl,$text);
        if ($success) {
            session()->flash('success', 'L\'élément a bien été ajouté!');
        } else {
            session()->flash('error', 'Une erreur est survenue lors de l\'ajout.');
        }
        //dd($selection, $texte);
        return redirect()->route('superadmin.addcomp');


    }
}
