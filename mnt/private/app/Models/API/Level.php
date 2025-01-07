<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Level extends Model
{
    use HasFactory;

    protected $table = 'NIVEAU';
    protected $primaryKey = 'NIV_ID';

    protected $fillable = [
        'NIV_DESCRIPTION',
    ];

    protected $hidden = [];

}
