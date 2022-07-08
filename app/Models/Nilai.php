<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'detnilai';
    protected $fillable = ['nisn', 'id_kelas', 'id_mapel', 'nilai', 'id_kuri'];

    public $incrementing = false;

    public function siswa(){
        return $this -> belongsTo(Siswa::class, 'nisn');
    }
    public function kelas(){
        return $this -> belongsTo(Kelas::class, 'id_kelas');
    }
    public function kurikulum(){
        return $this -> belongsTo(Kurikulum::class, 'id_kuri');
    }
}
