<?php

namespace App\Http\Controllers;

use App\Models\Uti;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

session_start();

class StudentResultsController extends Controller
{
    public function index()
    {

    }

    public function getCompetences(){
        $competences = DB::select('select * from competence');
        return $competences;
    }

    public function getSkillsByCompetence($competenceId){
        $skillsByC = DB::select('select * from aptitude join competence using(com_id) group by com_id having com_id = ?',[$competenceId]);
        return $skillsByC;
    }


    public function show(){
        return view('skillsdetails');
    }
}