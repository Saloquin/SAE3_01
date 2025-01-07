<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Skill;
use App\Models\Uti;

class SessionController extends Controller
{
    public function index() {
        $skill = Skill::getSkillByFormationLevel();
        $student = Uti::getStudent();
        $initiator = Uti::getTeacher();
        return view('CreateSession', ['skills' => $skill, 'student' => $student, 'initiator' => $initiator]);
    }

    public function executeRequest() {
        $skill = Skill::getSkillByFormationLevel();
        $student = Uti::getStudent();

        // Session::insertSession($for_id, $cou_date, $uti_id_elv1, $uti_id_elv2, $uti_id_init);

        print_r($_POST);
        print_r("<br>");

        return "ok";

        // return view('CreateSession', ['skills' => $skill, 'student' => $student, 'initiator' => $initiator]);
    }
}
