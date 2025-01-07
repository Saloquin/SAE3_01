<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Iniator extends Model
{
    use HasFactory;

    public static function fetchAll() {
        $users = DB::select('select * from UTILISATEUR where uti_est_init = 1');

        return $users;
    }
}
