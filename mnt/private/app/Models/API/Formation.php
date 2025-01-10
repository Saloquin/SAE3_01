<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'FORMATION';
    protected $primaryKey = 'FOR_ID';

    protected $fillable = [
        'NIV_ID',
        'UTI_ID',
        'CLU_ID',
        'FOR_ANNEE',
    ];

    protected $hidden = [];

    public function responsable()
    {
        return $this->belongsTo(Uti::class, 'CLU_ID');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'NIV_ID');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'CLU_ID');
    }

    public function eleve()
    {
        return $this->hasMany(Learn::class, 'FOR_ID');
    }

    public function initiator()
    {
        return $this->hasMany(Teach::class, 'FOR_ID');
    }
    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'FOR_ID');
    }
}
