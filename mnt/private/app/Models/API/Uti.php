<?php

namespace App\Models\API;

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
        'UTI_DATE_NAISS',
        'UTI_DATE_CERTIF',
        'UTI_VILLE',
        'UTI_CP',
        'UTI_LICENCE',
        'UTI_RUE',
    ];

    protected $hidden = [
        'UTI_MDP',
    ];

    public function student()
    {
        return $this->hasMany(Learn::class, 'UTI_ID');
    }

    public function teacher()
    {
        return $this->hasMany(Teach::class, 'UTI_ID');    
    }

    public function dtclub()
    {
        return $this->hasMany(Club::class, 'UTI_ID');
    }
    public function respform(){
        return $this->hasMany(Formation::class, 'UTI_ID');
    }
    public function group()
    {
        return $this->hasMany(Group::class, 'UTI_ID');
    }
    public function mastery()
    {
        return $this->hasMany(Mastery::class, 'UTI_ID');
    }
    public function validate(){
        return $this->hasMany(Validate::class, 'UTI_ID');
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
