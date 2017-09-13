<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PromoSlideModel extends Model
{
    public $timestamps = false;
    protected $table = 'promo_slide';
    protected $fillable = ['id_slide', 'nama_promo', 'image_slide',  'date_start_slide', 'date_end_slide',  'created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['id_produk', 'nama_produk', 'nama_outlate'];
    }
    public static function getAllDataProd($input, $status) {
        $query = "
                select 
                pr.id_produk, 
                pr.id_slide,
                p.nama_produk,
                o.nama_outlate
                from promo_slide_role as pr 
                LEFT JOIN produk as p on pr.id_produk = p.id_produk
                LEFT JOIN outlate as o on p.id_merchant = o.id_merchant
            where 1=1
            ";
        if (!empty($input['id_slide'])) {
            $query .= " and pr.id_slide  = '".$input['id_slide']."' ";
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
