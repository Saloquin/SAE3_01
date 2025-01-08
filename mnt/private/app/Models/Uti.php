<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uti extends Model
{
    use HasFactory;

    protected $table = 'UTILISATEUR';
    protected $primaryKey = 'UTI_ID';
    public $timestamps = false;
    protected $fillable = [
        'NIV_ID',
        'CLU_ID',
        'UTI_NOM',
        'UTI_PRENOM',
        'UTI_MAIL',
        'UTI_MDP',
        'UTI_DATE_ARCHIVAGE',
        'UTI_EST_INIT',
        'UTI_LICENCE',
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

    public function club()
    {
        return $this->belongsTo(Club::class, 'CLU_ID');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'NIV_ID');
    
    }

    public function learnings()
    {
        return $this->hasMany(Learn::class, 'UTI_ID');
    }

    public function teaching()
    {
        return $this->hasMany(Teach::class, 'UTI_ID');
    }

    
}
