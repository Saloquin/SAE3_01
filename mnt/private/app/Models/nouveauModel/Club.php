<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $table = 'club';
    protected $primaryKey = 'CLU_ID';
    public $timestamps = false;
    protected $fillable = [
        'UTI_ID',
        'CLU_NOM',
        'CLU_VILLE',
    ];

    public function DT()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }
}
