<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_guru extends Model
{
    protected $table = 'detail_guru';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'id_mapel'];
    protected $guarded = [];

    public $incrementing = false;
    public function guru(){
        return $this -> morphTo(__FUNCTION__,'guru_id','guru_type');
    }
}
