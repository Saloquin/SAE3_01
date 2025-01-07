<?php

namespace App\Http\Controllers;

use App\Models\Iniator;
use Illuminate\Http\Request;
use App\Models\Skill;

use App\Models\Student;

class SessionController extends Controller
{
    public function index(){
        $skill = Skill::fetchAll();
        $student = Student::fetchAll();
        $initiator = Iniator::fetchAll();
        return view('CreateSession', ['skills' => $skill, 'student' => $student, 'initiator' => $initiator]);
    }
}
