<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    use HasFactory;

    public static function getAllSkill() {
        $users = DB::select('select * from APTITUDE');

        return $users;
    }

    public static function getSkillByFormationLevel(){
        $users = DB::select('select * from APTITUDE where COM_ID in (SELECT COM_ID FROM FORMATION WHERE NIV_ID = ?)', [1]);

        return $users;
    }
}
