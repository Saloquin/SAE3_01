<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groupe';
    protected $primaryKey = 'GRO_ID';
    public $timestamps = false;
    protected $fillable = [
        'COU_ID',
        'UTI_ID_ELV2',
        'UTI_ID_ELV1',
        'UTI_ID_INIT',
    ];

    public function course()
    {
        return $this->belongsTo(Lesson::class, 'COU_ID');
    }

    public function student1()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID_ELV1');
    }

    public function student2()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID_ELV2');
    }

    public function instructor()
    {
        return $this->belongsTo(Uti::class, 'UTI_ID_INIT');
    }
}
