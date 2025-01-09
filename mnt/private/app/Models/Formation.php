<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formation';
    protected $primaryKey = 'FOR_ID';
    public $timestamps = false;
    protected $fillable = [
        'NIV_ID',
        'UTI_ID',
        'CLU_ID',
        'FOR_ANNEE',
    ];

    protected $hidden = [];

    public function responsable()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID')->withoutGlobalScope('non_archived');;
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'NIV_ID');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'CLU_ID');
    }

    public function learn()
    {
        return $this->hasMany(Learn::class, 'FOR_ID');
    }
    
}
