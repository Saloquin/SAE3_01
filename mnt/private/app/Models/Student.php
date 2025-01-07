<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    public static function getAllStudent() {
        $users = DB::select('select * from UTILISATEUR where uti_est_init = 0');

        return $users;
    }

    public static function getStudentByFormationLevel(){
        $users = DB::select('select * from UTILISATEUR where uti_est_init = 0 and NIV_ID in (SELECT NIV_ID-1 FROM FORMATION WHERE NIV_ID = ?)', [1]);

        return $users;
    }
}
