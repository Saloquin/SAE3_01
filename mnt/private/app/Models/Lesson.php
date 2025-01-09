<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'COURS';
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

    public static function insertGroup($uti_id_elv1, $uti_id_elv2, $uti_id_init, $aptitudes1, $aptitudes2)
    {
        $cou_id = intval(DB::table('COURS')->max('COU_ID'));
        DB::table('GROUPE')->insert([
            'COU_ID' => $cou_id,
            'UTI_ID_ELV1' => $uti_id_elv1,
            'UTI_ID_ELV2' => $uti_id_elv2,
            'UTI_ID_INIT' => $uti_id_init,
        ]);

        foreach ($aptitudes1 as $aptitude) {
            DB::table('MAITRISER')->insert([
                'COU_ID' => $cou_id,
                'UTI_ID' => $uti_id_elv1,
                'APT_ID' => $aptitude,
            ]);
        }

        if ($uti_id_elv2) {
            foreach ($aptitudes2 as $aptitude) {
                DB::table('MAITRISER')->insert([
                    'COU_ID' => $cou_id,
                    'UTI_ID' => $uti_id_elv2,
                    'APT_ID' => $aptitude,
                ]);
            }
        }

    }

    public static function insertLesson($for_id, $cou_date)
    {
        $cou_id = intval(DB::table('COURS')->max('COU_ID')) + 1;

        DB::table('COURS')->insert([
            'COU_ID' => $cou_id,
            'FOR_ID' => $for_id,
            'COU_DATE' => $cou_date,
        ]);

       
    }
}
