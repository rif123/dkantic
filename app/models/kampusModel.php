<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kampusModel extends Model
{
    protected $table = 'm_kampus';
    protected $fillable = ['id_kampus', 'nama_kampus', 'id_kota',  'created', 'creator', 'edited', 'editor'];
}
