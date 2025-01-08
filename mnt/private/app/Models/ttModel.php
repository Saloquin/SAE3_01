<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ttModel extends Model
{
    use HasFactory;


    public static function getSessionInitiatorById($id){
        return DB::select('SELECT c.cou_id, cou_date, uti_id_elv1, uti_id_elv2, u.niv_id+1, u.uti_nom, u.uti_prenom, u2.uti_nom as uti_nom2, u2.uti_prenom as uti_prenom2, u.niv_id+1 as niv FROM COURS c 
            join groupe g on g.COU_ID = c.COU_ID 
            join UTILISATEUR u on g.uti_id_elv1 = u.uti_id
            left join UTILISATEUR u2 on g.uti_id_elv2 = u2.uti_id
            where g.UTI_ID_INIT = ?', [$id]); 
    }

    public static function getSessionStudentById($id){
        return DB::select('SELECT cou_date, apt_libelle FROM COURS c 
            join GROUPE g on g.COU_ID = c.COU_ID 
            join MAITRISER m on m.cou_id = c.cou_id
            join APTITUDE a on a.apt_id = m.apt_id
            where (g.UTI_ID_ELV1 = ? or g.UTI_ID_ELV2 = ?) and m.uti_id = ?', [$id, $id, $id]); 
    }
}
