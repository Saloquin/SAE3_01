<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastery extends Model
{
    use HasFactory;

    protected $table = 'maitriser';
    protected $primaryKey = ['COU_ID', 'UTI_ID', 'APT_ID'];
    public $incrementing = false; // Disable auto-increment as this table uses a composite primary key.

    protected $fillable = [
        'COU_ID',
        'UTI_ID',
        'APT_ID',
        'MAI_PROGRESS',
        'MAI_COMMENTAIRE',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'COU_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UTI_ID');
    }

    public function aptitude()
    {
        return $this->belongsTo(Aptitude::class, 'APT_ID');
    }
}
