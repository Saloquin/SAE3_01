<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ttInitiatorModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function getCoursById($id){
        return DB::select('SELECT cou_date, uti_id_elv1, uti_id_elv2, u.niv_id+1, u.uti_nom, u.uti_prenom, u2.uti_nom as uti_nom2, u2.uti_prenom as uti_prenom2, u.niv_id+1 as niv FROM cours c 
            join groupe g on g.COU_ID = c.COU_ID 
            join utilisateur u on g.uti_id_elv1 = u.uti_id
            left join utilisateur u2 on g.uti_id_elv2 = u2.uti_id
            where g.UTI_ID_INIT = ?', [$id]); 
    }
}
