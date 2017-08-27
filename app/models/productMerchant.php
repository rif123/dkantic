<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class productMerchant extends Model
{
    public $timestamps = false;
    protected $table = 'produk';
    protected $fillable = ['id_produk', 'id_merchant', 'nama_produk','ket_produk','img_produk', 'created', 'creator', 'edited', 'editor'];
}
