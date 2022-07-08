<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama_kelas', 'nip', 'id_tingkat', 'id_kuri'];

    public $incrementing = false;
    public function siswa(){
        return $this -> hashMany(Siswa::class);
    }
    public function mapel(){
        return $this -> hashMany(Mapel::class);
    }
    public function rapot(){
        return $this -> hashMany(Rapot::class);
    }
    public function guru(){
        return $this -> belongsTo(Guru::class, 'nip' );
    }
    public function tingkat(){
        return $this -> belongsTo(Tingkat::class, 'id_tingkat' );
    }
    public function kurikulum(){
        return $this -> belongsTo(Kurikulum::class, 'id_kuri' );
    }

}