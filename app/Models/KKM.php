<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KKM extends Model
{
    protected $table = 'kkm';
    protected $fillable = ['set_kkm'];
    protected $primaryKey = 'id';
    public $incrementing = false;
}
