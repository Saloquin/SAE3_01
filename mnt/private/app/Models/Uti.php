<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uti extends Model
{
    use HasFactory;

    protected $table = 'UTILISATEUR';
    protected $primaryKey = 'UTI_ID';

    protected $fillable = [
        'NIV_ID',
        'CLU_ID',
        'UTI_NOM',
        'UTI_PRENOM',
        'UTI_MAIL',
        'UTI_MDP',
        'UTI_DATE_ARCHIVAGE',
        'UTI_EST_INIT',
    ];

    protected $hidden = [
        'UTI_MDP',
    ];

    public static function getStudent()
    {
        return self::where('UTI_EST_INIT', 0)->get();
    }

    public static function getStudentByFormation()
    {
        return self::where('UTI_EST_INIT', 0)
                    ->where('NIV_ID', 0)->get();
    }

    public static function getTeacher()
    {
        return self::where('UTI_EST_INIT', 1)->get();
    }
    public static function getInitiatorById($id){
        return self::where('uti_id', $id)
                    ->where('uti_est_init', 1)->get();
    }
}
