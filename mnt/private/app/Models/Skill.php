<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    use HasFactory;
    protected $primaryKey = 'APT_ID';
    protected $table = 'APTITUDE';
    public $timestamps = false;
    protected $fillable = [
		'COM_ID' ,
		'NIV_ID',
		'APT_LIBELLE'	
    ];


    public static function getAllSkill() {
        $users = DB::select('select * from APTITUDE');

        return $users;
    }

    public static function addNew($comp, $desc){
        $result = DB::insert('INSERT into aptitude(apt_id,com_id,apt_libelle)
        VALUES(NULL, ?, ?)',[$comp, $desc]);
        return $result;
    }

    public static function getSkillByFormationLevel($formationLevel){
        $users = DB::select('select * from APTITUDE where COM_ID in (SELECT COM_ID FROM FORMATION WHERE NIV_ID = ?)', [$formationLevel]);
        return $users;
    }
}
