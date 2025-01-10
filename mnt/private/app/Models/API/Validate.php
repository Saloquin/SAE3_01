<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validate extends Model
{
    use HasFactory;

    protected $table = 'VALIDER';
    public function getKeyName()
    {
        return ['APT_ID', 'UTI_ID'];
    }
    public $incrementing = false; // Disable auto-increment as this table uses a composite primary key.

    protected $fillable = [
        'UTI_ID',
        'APT_ID',
        'VAL_STATUT',
    ];

    public function user()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID');
    }

    public function aptitude()
    {
        return $this->belongsTo(Skill::class, 'APT_ID');
    }
}
