<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class trainingInf extends Model
{
    use HasFactory;

    public static function getStudentByFor($id){
        return DB::select("SELECT uti_licence, uti_nom, uti_prenom, uti_mail, niv_id, uti_date_certif, uti_date_naiss FROM apprendre
                            join utilisateur using (uti_id)
                            where for_id = ?", [$id]);
    }
    public static function getInitiatorByFor($id){
        return DB::select("SELECT uti_licence, uti_nom, uti_prenom, uti_mail, niv_id, uti_date_certif, uti_date_naiss FROM initier
                            join utilisateur using (uti_id)
                            where for_id = ?", [$id]);
    }
}