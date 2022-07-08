<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';

    protected $primaryKey = 'id_kuri';

    protected $fillable = ['tahun_ajaran', 'semester'];
    public $incrementing = false;
    public function rapot(){
        return $this -> hashMany(Rapot::class);
    }
    public function kelas(){
        return $this -> hashMany(Kelas::class);
    }
    public function nilai(){
        return $this -> hashMany(Nilai::class);
    }
}
