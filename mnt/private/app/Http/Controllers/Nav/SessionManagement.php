<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Skill;
use App\Models\Uti;

Class SessionManagement extends Controller{

    public function show(){
        $skills = Skill::getSkillByFormationLevel();
        $students = Uti::getStudent();
        $initiators = Uti::getTeacher();
        
        return view('sessionmanagement', ['skills' => $skills, 'student' => $students, 'initiator' => $initiators]);
    }

}