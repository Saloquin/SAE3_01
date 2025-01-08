<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
    use HasFactory;

    public static function insertSession($for_id, $cou_date, $uti_id_elv1, $uti_id_elv2, $uti_id_init, $skillList) {
        $cou_id = intval(DB::select("select max(cou_id) as cou_id from COURS")[0]->cou_id) + 1;
    
        $cou_date = $cou_date->format('Y-m-d H:i:s');
    
        DB::insert("insert into COURS (cou_id, for_id, cou_date) values (?, ?, ?)", [$cou_id, $for_id, $cou_date]);
        DB::insert("insert into GROUPE (cou_id, uti_id_elv1, uti_id_elv2, uti_id_init) values (?, ?, ?, ?)", [$cou_id, $uti_id_elv1, $uti_id_elv2, $uti_id_init]);

        foreach ($skillList as $skillId) {
            DB::insert("insert into MAITRISER (cou_id, uti_id, apt_id, mai_progress, mai_commentaire) values (?, ?, ?, ?, ?)", [$cou_id, $uti_id_elv1, $skillId, 'non évaluée', '']);

            if ($uti_id_elv2) {
                DB::insert("insert into MAITRISER (cou_id, uti_id, apt_id, mai_progress, mai_commentaire) values (?, ?, ?, ?, ?)", [$cou_id, $uti_id_elv2, $skillId, 'non évaluée', '']);
            }
        }
    }

    public static function getStudentSkillsAtSession($cou_id, $uti_id) {
        if (!$uti_id) {
            return array();
        }

        $skillsIds = DB::select("select apt_id from MAITRISER where cou_id = ? and uti_id = ?", [$cou_id, $uti_id]);

        $skills = array();

        foreach ($skillsIds as $skillId) {
            $skill = DB::select("select * from APTITUDE where apt_id = ?", [$skillId]);

            array_push($skills, $skill);
        }
        
        return $skills;
    }

    public static function getStudentsOfInitiatorAtSession($cou_id, $uti_id_init) {
        $res = DB::select("select * from GROUPE where cou_id = ? and uti_id_init = ?", [$cou_id, $uti_id_init])[0];
        
        return [$res->uti_id_elv1, $res->uti_id_elv2];
    }
    
    
}
