<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_kelas extends Model
{
    protected $table = 'detail_kelas';
    protected $fillable = ['nisn', 'id_kelas'];

    public $incrementing = false;
}
