<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class addclubController extends Controller
{
    public function show(){
        session_start();
        require_once('../resources/includes/header.php');
        require_once('../resources/includes/navbar/navbar_admin.php');

        $req = User::getLevels();
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
        $text = $request->input('texte');
        $success = Competence::addNew($selection,$text);
        if ($success) {
            session()->flash('success', 'L\'élément a bien été ajouté!');
        } else {
            session()->flash('error', 'Une erreur est survenue lors de l\'ajout.');
        }
        //dd($selection, $texte);
        return redirect()->route('superadmin');


    }
}
