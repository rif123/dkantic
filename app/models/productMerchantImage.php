<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class productMerchantImage extends Model
{
    public $timestamps = false;
    protected $table = 'produk_image';
    protected $fillable = ['id_image_produk', 'id_produk', 'name_image_produk'];
}
