<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $table = 'CLUB';
    protected $primaryKey = 'CLU_ID';

    protected $fillable = [
        'UTI_ID',
        'CLU_NOM',
        'CLU_VILLE',
    ];

    public function DT()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }

    public function formation()
    {
        return $this->hasMany(Formation::class, 'CLU_ID');
    }

    public function membre()
    {
        return $this->hasMany(Uti::class, 'CLU_ID');
    }
}
