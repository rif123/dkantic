<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PromoSlideRoleModel extends Model
{
    public $timestamps = false;
    protected $table = 'promo_slide_role';
    protected $fillable = ['id_produk', 'id_slide',  'created', 'creator', 'edited', 'editor'];
}
