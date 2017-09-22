<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class userMerchant extends Model
{
    public $timestamps = false;
    protected $table = 'users_merchant';
    protected $fillable = ['id_merchant', 'username_merchant','pass_merchant', 'created', 'creator', 'edited', 'editor'];
    
    public static function getProdByid($id) {
        $query  = "select * from produk as pr
                LEFT JOIN produk_image as pi on pr.id_produk  = pi.id_produk
                WHERE pr.id_produk = '".$id."'
        ";
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }
}
