<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    use HasFactory;
    protected $primaryKey = 'APT_ID';
    protected $table = 'aptitude';
    public $timestamps = false;
    protected $fillable = [
		'COM_ID' ,
		'NIV_ID',
		'APT_LIBELLE'	
    ];

    
}
