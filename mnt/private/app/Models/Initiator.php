<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Initiator extends Model
{
    use HasFactory;

    public static function getAllInitiator() {
        $users = DB::select('select * from UTILISATEUR where uti_est_init = 1');

        return $users;
    }

    public static function editProgression($cou_id, $uti_id, $apt_id, $mai_progress, $mai_commentaire) {
        DB::update("update MAITRISER set mai_progress = ? and mai_commentaire = ? where cou_id = ? and uti_id = ? and apt_id = ?", [$mai_progress, $mai_commentaire, $cou_id, $uti_id, $apt_id]);

        return "ok";
    }


}
