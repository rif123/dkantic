<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kategoriModel extends Model
{
    protected $table = 'm_kategori';
    protected $fillable = ['id_kategori', 'nama_kategori','created', 'creator', 'edited', 'editor'];
}
