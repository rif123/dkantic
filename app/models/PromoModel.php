<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PromoModel extends Model
{
    public $timestamps = false;
    protected $table = 'promo';
    protected $fillable = ['id_promo', 'nama_promo', 'image_promo',  'date_start_promo', 'date_end_promo',  'status', 'created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['id_produk', 'nama_produk', 'nama_outlate'];
    }
    public static function getAllDataProd($input, $status) {
        $query = "
                select 
                pr.id_produk, 
                pr.id_promo,
                p.nama_produk,
                o.nama_outlate
                from promo_role as pr 
                LEFT JOIN produk as p on pr.id_produk = p.id_produk
                LEFT JOIN outlate as o on p.id_merchant = o.id_merchant
            where 1=1
            ";
        if (!empty($input['id_promo'])) {
            $query .= " and pr.id_promo  = '".$input['id_promo']."' ";
        }
        if (!empty($input['search']['value'])) {
            $query .= " and nama_produk like  '%".$input['search']['value']."%' and nama_outlate like '%".$input['search']['value']."%'";
        }
        $order = "";
        if (!empty($input['order'])) { // here order processing
            $colum  = self::column_order();
            $col  = $colum[$input['order']['0']['column']];
            
            $query .= " ORDER BY  ".$col." ".$input['order']['0']['dir'];
        }
        if ($status) {
            $query  .= " LIMIT ".$input['length']." OFFSET ".$input['start'];
        }
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }

}
