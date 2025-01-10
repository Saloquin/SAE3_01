<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastery extends Model
{
    use HasFactory;

    protected $table = 'MAITRISER';
    public function getKeyName()
    {
        return ['COU_ID', 'UTI_ID', 'APT_ID'];
    }
    public $incrementing = false; 
    protected $fillable = [
        'COU_ID',
        'UTI_ID',
        'APT_ID',
        'MAI_PROGRESS',
        'MAI_COMMENTAIRE',
    ];


    public function course()
    {
        return $this->belongsTo(Lesson::class, 'COU_ID');
    }

    public function user()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }

    public function aptitude()
    {
        return $this->belongsTo(Skill::class, 'APT_ID');
    }
}
