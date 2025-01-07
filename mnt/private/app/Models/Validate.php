<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    protected $table = 'valider';
    protected $primaryKey = ['UTI_ID', 'APT_ID'];
    public $timestamps = false;

    protected $fillable = [
        'UTI_ID',
        'APT_ID',
        'VAL_STATUT',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UTI_ID');
    }

    public function aptitude()
    {
        return $this->belongsTo(Skill::class, 'APT_ID');
    }
}
