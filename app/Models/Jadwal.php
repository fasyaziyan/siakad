<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = ['judul', 'keterangan', 'tanggal_mulai', 'tanggal_selesai', 'status'];
    protected $primaryKey = 'id';
    public $incrementing = false;
}
