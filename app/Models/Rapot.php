<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'rapot';
    protected $fillable = ['nisn', 'id_kuri', 'id_kelas', 'keterangan', 'sakit', 'izin', 'alpa'];
    public $incrementing = false;
    public function siswa(){
        return $this -> belongsTo(Siswa::class, 'nisn');
    }
    public function kurikulum(){
        return $this -> belongsTo(Kurikulum::class, 'id_kuri');
    }
    public function kelas(){
        return $this -> belongsTo(Kelas::class, 'id_kelas');
    }
}

    
