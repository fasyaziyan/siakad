<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Guru extends Authenticatable
{
    use Notifiable;
    protected $table = 'guru';

    protected $primaryKey = 'nip';
    protected $fillable = ['nip','nama_guru', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat',
'telepon','agama','pendidikan', 'level', 'email', 'password', 'foto'];

protected $hidden = [
    'password', 'remember_token',
];

protected $casts = [
    'email_verified_at' => 'datetime',
];

public function mapel(){
    return $this -> hashMany(Mapel::class);
}
public function kelas(){
    return $this -> hashMany(Kelas::class);
}
public function detgurus(){
    return $this -> hashMany(Detail_guru::class);
}
}
