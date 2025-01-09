<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Competence;
use Illuminate\Http\Request;

class addAptController extends Controller
{
    public function show(){
        session_start();
        require_once('../resources/includes/header.php');
        if(isset($_SESSION['director'])){ require_once('../resources/includes/navbar/navbar_director.php'); }
        if (isset($_SESSION['manager'])){ require_once('../resources/includes/navbar/navbar_manager.php'); }
        if (isset($_SESSION['teacher'])){ require_once('../resources/includes/navbar/navbar_teacher.php'); }
        if (isset($_SESSION['student'])){ require_once('../resources/includes/navbar/navbar_student.php'); }
        $req = Competence::getCompetencies();
        //var_dump($levels);
        $comp = [];
        foreach($req as $row){
            $str = "Niveau : " . $row->niv_id . ", Compétence : " . $row->com_libelle;
            array_push($comp, $str);
        }
        return view('addAptView', compact('comp'));
    } 

    public function add(Request $request){
        $selection = $request->input('selection');
        $text = $request->input('texte');
        $success = Skill::addNew($selection+1,$text);
        if ($success) {
            session()->flash('success', 'L\'élément a bien été ajouté!');
        } else {
            session()->flash('error', 'Une erreur est survenue lors de l\'ajout.');
        }
        //dd($selection+1, $text);
        return redirect()->route('superadmin');
        
        
    }
}
