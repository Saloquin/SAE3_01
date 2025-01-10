<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'COMPETENCE';
    protected $primaryKey = 'COM_ID';

    protected $fillable = [
        'NIV_ID',
        'COM_LIBELLE',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'NIV_ID');
    }

    public function aptitude()
    {
        return $this->hasMany(Skill::class, 'COM_ID');
    }
}
