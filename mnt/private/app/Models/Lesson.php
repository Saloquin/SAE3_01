<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'cours';
    protected $primaryKey = 'COU_ID';
    public $timestamps = false;
    protected $fillable = [
        'FOR_ID',
        'COU_DATE',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'FOR_ID');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'COU_ID');
    }

    public function masteries()
    {
        return $this->hasMany(Mastery::class, 'COU_ID');
    }

    public static function insertLesson($for_id, $cou_date, $uti_id_elv1, $uti_id_elv2, $uti_id_init, $aptitudes)
    {
        
        $lesson = self::create([
            'FOR_ID' => $for_id,
            'COU_DATE' => $cou_date,
        ]);

       
        $group = Group::create([
            'COU_ID' => $lesson->COU_ID,
            'UTI_ID_ELV1' => $uti_id_elv1,
            'UTI_ID_ELV2' => $uti_id_elv2,
            'UTI_ID_INIT' => $uti_id_init,
        ]);

        
        foreach ($aptitudes as $aptitude) {
            Mastery::create([
                'COU_ID' => $lesson->COU_ID,
                'UTI_ID' => $uti_id_elv1,
                'APT_ID' => $aptitude,
                'MAI_PROGRESS' => 0, 
                'MAI_COMMENTAIRE' => '',
            ]);
        }

        
        if ($uti_id_elv2) {
            foreach ($aptitudes as $aptitude) {
                Mastery::create([
                    'COU_ID' => $lesson->COU_ID,
                    'UTI_ID' => $uti_id_elv2,
                    'APT_ID' => $aptitude,
                    'MAI_PROGRESS' => 0, 
                    'MAI_COMMENTAIRE' => '',  
                ]);
            }
        }
    }
}
