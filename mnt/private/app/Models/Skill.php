<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    use HasFactory;

    public static function fetchAll() {
        $users = DB::select('select * from APTITUDE');

        return $users;
    }
}
