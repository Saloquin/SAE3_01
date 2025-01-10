<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'COURS';
    protected $primaryKey = 'COU_ID';

    protected $fillable = [
        'FOR_ID',
        'COU_DATE',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'FOR_ID');
    }

    public function group()
    {
        return $this->hasMany(Group::class, 'COU_ID');
    }

    public function mastery()
    {
        return $this->hasMany(Mastery::class, 'COU_ID');
    }
}
