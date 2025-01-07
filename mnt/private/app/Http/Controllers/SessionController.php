<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;


class SessionController extends Controller
{
    public function index(){
        $skill = Skill::getAllSkill();
        return view('CreateSession', ['skills' => $skill]);
    }
}
