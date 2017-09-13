<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PromoRoleModel extends Model
{
    public $timestamps = false;
    protected $table = 'promo_role';
    protected $fillable = ['id_produk', 'id_promo', 'status', 'created', 'creator', 'edited', 'editor'];
}
