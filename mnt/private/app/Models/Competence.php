<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competence';
    protected $primaryKey = 'COM_ID';
    public $timestamps = false;
    protected $fillable = [
        'NIV_ID',
        'COM_LIBELLE',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'NIV_ID');
    }

    public static function getCompetencies(){
        return DB::select('select niv_id, com_id, com_libelle from COMPETENCE order by com_id');
    }

    public static function addNew($lvl, $desc){
        return DB::insert('INSERT into competence(com_id,niv_id, com_libelle)
        VALUES(NULL, ?, ?)',[$lvl, $desc]);
    }
}
