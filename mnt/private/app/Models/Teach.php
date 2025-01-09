<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    use HasFactory;

    protected $table = 'initier';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $primaryKey = ['FOR_ID', 'UTI_ID'];
    protected $fillable = [
        'UTI_ID',
        'FOR_ID',
    ];

    public function initiator()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'FOR_ID');
    }
}