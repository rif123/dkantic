<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kotaModel extends Model
{
    public $timestamps = false;
    protected $table = 'm_kota';
    protected $fillable = ['id_Kota', 'nama_kota','created', 'creator', 'edited', 'editor'];
}
