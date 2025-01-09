<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class LevelConf extends Model
{
    use HasFactory;
    public static function getStudentConf(){
        return DB::select("select u.uti_id, uti_licence, uti_nom, uti_prenom, uti_mail, u.niv_id, uti_date_certif, uti_date_naiss from utilisateur u
        join valider v on u.uti_id = v.uti_id
        join formation f on u.uti_id = f.uti_id
        where u.uti_id not in(
        select uti_id from valider where VAL_STATUT = 0)
        and u.niv_id < f.niv_id;");
    }
    public static function acceptForm($id){
        DB::update("update utilisateur
        set niv_id = niv_id +1 where uti_id = ?", [$id]);
    }

}
