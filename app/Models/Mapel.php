<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';

    protected $primaryKey = 'id_mapel';

    protected $fillable = ['nama_mapel', 'nip', 'id_kelas'];
    public $incrementing = false;

    public function guru(){
        return $this -> belongsTo(Guru::class, 'nip');
    }
    public function kelas(){
        return $this -> belongsTo(Kelas::class, 'id_kelas');
    }
}
