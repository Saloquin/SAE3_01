<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
  use HasFactory;
  protected $primaryKey = 'APT_ID';
  protected $table = 'APTITUDE';

  protected $fillable = [
    'COM_ID',
    'NIV_ID',
    'APT_LIBELLE'
  ];

  public function competence()
  {
    return $this->belongsTo(Competence::class, 'COM_ID');
  }

  public function mastery()
  {
    return $this->hasMany(Mastery::class, 'APT_ID');
  }
  public function validate(){
    return $this->hasMany(Validate::class,'APT_ID');

  }
}
