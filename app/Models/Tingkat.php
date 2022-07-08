<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table = 'tingkat';
    protected $primaryKey = 'id_tingkat';
    protected $fillable = ['nama_tingkat'];
    public $incrementing = false;
}
