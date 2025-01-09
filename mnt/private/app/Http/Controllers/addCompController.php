<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Competence;

class addCompController extends Controller
{
    public function show(){
        session_start();
        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }
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
