<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Competence;
use Illuminate\Http\Request;

class addAptController extends Controller
{
    public function show(){
        session_start();

        if(!isset($_SESSION['id'])){
            header('Location: /connexion');
            exit;
        }

        require_once('../resources/includes/header.php');
        require_once('../resources/includes/navbar/navbar_admin.php');

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
        $selection = $request->input('selectionText');
        $text = $request->input('texte');
        preg_match('/Niveau\s*:\s*(\d+)/', $selection, $lvlMatch);
        $lvl = isset($lvlMatch[1]) ? $lvlMatch[1] : null;
        preg_match('/Compétence\s*:\s*(.*)/', $selection, $compMatch);
        $comp = isset($compMatch[1]) ? $compMatch[1] : null;
    
        $success = Skill::addNew($lvl,$comp,$text);
        if ($success) {
            session()->flash('success', 'L\'élément a bien été ajouté!');
        } else {
            session()->flash('error', 'Une erreur est survenue lors de l\'ajout.');
        }
        //dd($selection+1, $text);
        return redirect()->route('superadmin.addapt');


    }
}
