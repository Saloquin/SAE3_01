<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
    use HasFactory;

    public static function insertSession($for_id, $cou_date, $uti_id_elv1, $uti_id_elv2, $uti_id_init, $aptitudes)
    {
        $cou_id = intval(DB::select("select max(cou_id) as cou_id from COURS")[0]->cou_id) + 1;
        DB::insert("insert into COURS (cou_id, for_id, cou_date) values (?, ?, ?)", [$cou_id, $for_id, $cou_date]);

        DB::insert("insert into GROUPE (cou_id, uti_id_elv1, uti_id_elv2, uti_id_init) values (?, ?, ?, ?)", [$cou_id, $uti_id_elv1, $uti_id_elv2, $uti_id_init]);

  
        foreach ($aptitudes as $aptitude) {
            DB::insert("insert into MAITRISER (COU_ID, UTI_ID, APT_ID) values (?, ?, ?)", [$cou_id, $uti_id_elv1, $aptitude]);
        }

        if ($uti_id_elv2) {
            foreach ($aptitudes as $aptitude) {
                DB::insert("insert into MAITRISER (COU_ID, UTI_ID, APT_ID) values (?, ?, ?)", [$cou_id, $uti_id_elv2, $aptitude]);
            }
        }
    }

}
