<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Uti extends Model
{
    use HasFactory;

    protected $table = 'utilisateur';
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

    public static function getStudentByFormation($formationLevel)
    {
        return self::where('UTI_EST_INIT', 0)
            ->where('NIV_ID', $formationLevel-1)->get();
    }

    public static function getTeacher()
    {
        return self::where('UTI_EST_INIT', 1)->get();
    }

    public static function getTeacherByFormation($formationLevel)
{
    return self::join('initier', 'initier.UTI_ID', '=', 'utilisateur.UTI_ID')
        ->where('initier.FOR_ID', $formationLevel)
        ->where('utilisateur.UTI_EST_INIT', 1) 
        ->get();
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

    public static function getStudentById($studentId){
        if (!$studentId) {
            return null;
        }

        $student = DB::select('select * from utilisateur where uti_id = ?', [$studentId])[0];

        return $student;
    }

    public static function editProgression($cou_id, $uti_id, $apt_id, $mai_progress, $mai_commentaire) {
        DB::update("update maitriser set mai_progress = ?, mai_commentaire = ? where cou_id = ? and uti_id = ? and apt_id = ?", [$mai_progress, $mai_commentaire, $cou_id, $uti_id, $apt_id]);
    }
}
