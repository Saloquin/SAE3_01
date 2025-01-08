<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'cours';
    protected $primaryKey = 'COU_ID';
    public $timestamps = false;
    protected $fillable = [
        'FOR_ID',
        'COU_DATE',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'FOR_ID');
    }

    public static function insertGroup($uti_id_elv1, $uti_id_elv2, $uti_id_init, $aptitudes1, $aptitudes2)
    {
        $cou_id = intval(DB::table('COURS')->max('COU_ID'));
        DB::table('GROUPE')->insert([
            'COU_ID' => $cou_id,
            'UTI_ID_ELV1' => $uti_id_elv1,
            'UTI_ID_ELV2' => $uti_id_elv2,
            'UTI_ID_INIT' => $uti_id_init,
        ]);

        foreach ($aptitudes1 as $aptitude) {
            DB::table('MAITRISER')->insert([
                'COU_ID' => $cou_id,
                'UTI_ID' => $uti_id_elv1,
                'APT_ID' => $aptitude,
            ]);
        }

        if ($uti_id_elv2) {
            foreach ($aptitudes2 as $aptitude) {
                DB::table('MAITRISER')->insert([
                    'COU_ID' => $cou_id,
                    'UTI_ID' => $uti_id_elv2,
                    'APT_ID' => $aptitude,
                ]);
            }
        }

    }

    public static function insertLesson($for_id, $cou_date)
    {
        $cou_id = intval(DB::table('COURS')->max('COU_ID')) + 1;

        DB::table('COURS')->insert([
            'COU_ID' => $cou_id,
            'FOR_ID' => $for_id,
            'COU_DATE' => $cou_date,
        ]);

       
    }

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

        foreach ($skillsIds as $row) {
            $skill = DB::select("select * from APTITUDE where apt_id = ?", [$row->apt_id])[0];

            array_push($skills, $skill);
        }
        
        return $skills;
    }

    public static function getStudentsOfInitiatorAtSession($cou_id, $uti_id_init) {
        $res = DB::select("select * from GROUPE where cou_id = ? and uti_id_init = ?", [$cou_id, $uti_id_init])[0];
        
        return [$res->UTI_ID_ELV1, $res->UTI_ID_ELV2];
    }

    public static function getSessionById($cou_id){
        if (!$cou_id) {
            return null;
        }

        $session = DB::select('select * from COURS where cou_id = ?', [$cou_id])[0];

        return $session;
    }

    public static function updateStudentSkillsAtSession($cou_id, $uti_id, $apt_id, $mai_progress, $mai_commentaire) {
        DB::update("update MAITRISER set mai_progress = ?, mai_commentaire = ? where cou_id = ? and uti_id = ? and apt_id = ?", [$mai_progress, $mai_commentaire, $cou_id, $uti_id, $apt_id]);
    }
}
