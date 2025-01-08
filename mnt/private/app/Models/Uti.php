<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uti extends Model
{
    use HasFactory;


    public $timestamps = false;

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
        'UTI_LICENSE',
        'UTI_DATE_NAISS',
        'UTI_DATE_CERTIF',
        'UTI_CP',
        'UTI_VILLE',
        'UTI_RUE'
    ];

    protected $hidden = [
        'UTI_MDP',
    ];

    public static function getStudent()
    {
        return self::where('UTI_EST_INIT', 0)->get();
    }

    public static function getTeacher()
    {
        return self::where('UTI_EST_INIT', 1)->get();
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'CLU_ID');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'NIV_ID');
    }
}
