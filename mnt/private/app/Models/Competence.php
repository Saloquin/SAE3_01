<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
