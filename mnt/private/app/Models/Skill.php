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
        $users = DB::select('select * from aptitude');

        return $users;
    }

    public static function getSkillWithLvl() {
        $users = DB::select('select niv_id, com_libelle, apt_libelle from aptitude a join competence c on a.com_id = c.com_id');

        return $users;
    }

    public static function addNew($lvl, $comp, $desc){
        $req = DB::select('SELECT com_id from competence where niv_id = ? and com_libelle = ?',[$lvl,$comp]);
        $compId = $req[0]->com_id;
        $result = DB::insert('INSERT into aptitude(apt_id,com_id,apt_libelle)
        VALUES(NULL, ?, ?)',[$compId, $desc]);
        return $result;
    }

    public static function getSkillByFormationLevel($formationLevel){
        $users = DB::select('select * from aptitude where COM_ID in (SELECT COM_ID FROM formation WHERE NIV_ID = ?)', [$formationLevel]);
        return $users;
    }

    public static function updt($lvl, $sk, $new){
        
        return DB::update('UPDATE aptitude SET apt_libelle = ?
            WHERE apt_libelle = ? and com_id in
            (select com_id from competence where niv_id = ?)',[$new,$sk,$lvl]);
    }
}
