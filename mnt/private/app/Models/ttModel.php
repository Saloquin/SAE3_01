<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ttModel extends Model
{
    use HasFactory;


    public static function getSessionInitiatorById($id){
        return DB::select('SELECT c.cou_id, cou_date, uti_id_elv1, uti_id_elv2, u.niv_id+1, u.uti_nom, u.uti_prenom, u2.uti_nom as uti_nom2, u2.uti_prenom as uti_prenom2, u.niv_id+1 as niv FROM cours c 
            join groupe g on g.COU_ID = c.COU_ID 
            join utilisateur u on g.uti_id_elv1 = u.uti_id
            left join utilisateur u2 on g.uti_id_elv2 = u2.uti_id
            where g.UTI_ID_INIT = ?', [$id]); 
    }

    public static function getSessionStudentById($id){
        return DB::select('SELECT cou_date, apt_libelle, u.uti_nom, u.uti_prenom, m.mai_progress FROM cours c 
            join groupe g on g.COU_ID = c.COU_ID 
            join maitriser m on m.cou_id = c.cou_id
            join aptitude a on a.apt_id = m.apt_id
            join utilisateur u on g.uti_id_init = u.uti_id
            where (g.UTI_ID_ELV1 = ? or g.UTI_ID_ELV2 = ?) and m.uti_id = ?', [$id, $id, $id]); 
    }

    public static function getCourseById($id){
        return DB::select('SELECT c.cou_date, c.cou_id from cours c
            join formation f on f.for_id = c.for_id
            where f.uti_id = ?', [$id] 
        );
    }
}
