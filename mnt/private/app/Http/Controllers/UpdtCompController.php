<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competence;

class UpdtCompController extends Controller
{
    public function show(){
        
        include resource_path('includes/header.php');

        $req = Competence::getCompetencies();
        $comp = [];
        foreach($req as $row){
            $str = "Niveau : " . $row->niv_id . ", Compétence : " . $row->com_libelle;
            array_push($comp, $str);
        }
        return view('updtCompView', compact('comp'));
    }

    public function updt(Request $request){
        $selection = $request->input('selectionText');
        $text = $request->input('texte');
        preg_match('/Niveau\s*:\s*(\d+)/', $selection, $lvlMatch);
        $lvl = isset($lvlMatch[1]) ? $lvlMatch[1] : null;
        preg_match('/Compétence\s*:\s*(.*)/', $selection, $compMatch);
        $comp = isset($compMatch[1]) ? $compMatch[1] : null;
        $success = Competence::updt($lvl, $comp,$text);
        if ($success) {
            session()->flash('success', 'L\'élément a bien été modifié!');
        } else {
            session()->flash('error', 'Une erreur est survenue lors de la modification.');
        }
        return redirect()->route('superadmin.updtcomp');


    }
}
