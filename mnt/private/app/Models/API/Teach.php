<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    use HasFactory;

    protected $table = 'INITIER';
    public $timestamps = false;

    protected $fillable = [
        'UTI_ID',
        'FOR_ID',
    ];

    public function teacher()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'FOR_ID');
    }
}