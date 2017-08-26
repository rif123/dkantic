<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class outlateModel extends Model
{
    public $timestamps = false;
    protected $table = 'outlate';
    protected $fillable = ['id_Kota', 'id_kampus', 'id_kategori','nama_outlate','nama_pemilik_outlate', 'alamat_outlate', 'hp_outlate', 'day_open_outlate', 'created', 'creator', 'edited', 'editor'];
}
