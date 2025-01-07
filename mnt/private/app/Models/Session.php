<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
    use HasFactory;

    public static function insertSession() {
        // $cou_id = select max + 1

        DB::insert("insert into COURS (cou_id, for_id, cou_date) values (?, ?, str_to_date(?, '%d-%m-%Y'))", [10, 1, '07-01-2025']);
        // DB::insert("insert into GROUPE (cou_id, cou_date) values (?, str_to_date(?, '%d-%m-%Y'))", [1, '07-01-2025']);
    }
}
