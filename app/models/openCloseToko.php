<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class openCloseToko extends Model
{
    public $timestamps = false;
    protected $table = 't_open_close_toko';
    protected $fillable = ['id_openclose', 'id_merchant', 'id_outlate','hari_open', 'jam_open', 'menit_open', 'jam_close', 'menit_close'];
}
