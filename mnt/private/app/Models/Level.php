<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Level extends Model
{
    use HasFactory;

    protected $table = 'niveau';
    protected $primaryKey = 'NIV_ID';
    public $timestamps = false;
    protected $fillable = [
        'NIV_DESCRIPTION',
    ];

    protected $hidden = [];

    public static function getLevels(){
        return DB::select("select niv_id, niv_description from NIVEAU");
    }

}
