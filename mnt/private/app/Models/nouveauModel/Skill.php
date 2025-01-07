<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    protected $primaryKey = 'APT_ID';
    protected $table = 'aptitude';

    protected $fillable = [
		'COM_ID' ,
		'NIV_ID',
		'APT_LIBELLE'	
    ];

    
}
