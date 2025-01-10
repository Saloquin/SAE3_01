<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learn extends Model
{
    use HasFactory;

    protected $table = 'APPRENDRE';
    public $timestamps = false;

    protected $fillable = [
        'UTI_ID',
        'FOR_ID',
    ];

    public function getKeyName()
    {
        return ['FOR_ID', 'UTI_ID'];
    }

    public function student()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'FOR_ID');
    }
}
