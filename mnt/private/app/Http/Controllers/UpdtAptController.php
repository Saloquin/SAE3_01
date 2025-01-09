<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class UpdtAptController extends Controller
{
    public function show(){
        session_start();
        require_once('../resources/includes/header.php');
        require_once('../resources/includes/navbar/navbar_admin.php');

        $req = Skill::getSkillWithLvl();
        //var_dump($levels);
        $comp = [];
        foreach($req as $row){
            $str = "Niveau : " . $row->niv_id . ", Compétence : " . $row->com_libelle . ", Aptitude : " . $row->apt_libelle;
            array_push($comp, $str);
        }
        return view('UpdtAptView', compact('comp'));
    }

    public function updt(Request $request){
        $selection = $request->input('selectionText');
        $text = $request->input('texte');
        preg_match('/Niveau\s*:\s*(\d+)/', $selection, $lvlMatch);
        $lvl = isset($lvlMatch[1]) ? $lvlMatch[1] : null;
        preg_match('/Aptitude\s*:\s*(.*)/', $selection, $skillMatch);
        $skill = isset($skillMatch[1]) ? $skillMatch[1] : null;
        $success = Skill::updt($lvl,$skill,$text);
        if ($success) {
            session()->flash('success', 'L\'élément a bien été modifié!');
        } else {
            session()->flash('error', 'Une erreur est survenue lors de la modification.');
        }
        return redirect()->route('superadmin.updtapt');
    }
}
