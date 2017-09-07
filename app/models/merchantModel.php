<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
class merchantModel extends Model
{
    public $timestamps = false;
    protected $table = 'user_merchant';
    protected $fillable = ['id_merchant', 'username_merchant', 'pass_merchant',  'created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['id_merchant', 'username_merchant', 'nama_kota', 'nama_kampus', 'nama_kategori', 'nama_outlate', 'nama_pemilik_outlate', 'alamat_outlate', 'hp_outlate', 'status_open_outlate'];
    }
    public static function getAllData($input, $status) {

        $query = " 
                select um.id_merchant, um.username_merchant, um.pass_merchant, 
                    mkot.nama_kota, mkm.nama_kampus,mkt.nama_kategori,
                    ot.id_kota, ot.id_kampus, ot.id_kategori, ot.nama_outlate, 
                    ot.nama_pemilik_outlate, ot.alamat_outlate, ot.hp_outlate, 
                    ot.status_open_outlate
                from users_merchant as um 
                LEFT JOIN outlate as ot on um.id_merchant = ot.id_merchant
                LEFT JOIN m_kota as mkot on ot.id_kota  = mkot.id_kota
                LEFT JOIN m_kampus as mkm on  ot.id_kampus = mkm.id_kampus
                LEFT JOIN m_kategori as mkt on ot.id_kategori = mkt.id_kategori
                where 1=1
            ";
        
        // if (!empty($input['search']['value'])) {
        //     $query .= " and nama_kampus like  '%".$input['search']['value']."%' ";
        // }
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
    public static function getDetailMerchant($input) {
        
        $query = " 
                select um.id_merchant, um.username_merchant, um.pass_merchant, 
                    mkot.nama_kota, mkm.nama_kampus,mkt.nama_kategori,
                    ot.id_kota, ot.id_kampus, ot.id_kategori, ot.nama_outlate, 
                    ot.nama_pemilik_outlate, ot.alamat_outlate, ot.hp_outlate, 
                    ot.status_open_outlate,pr.id_produk, pr.nama_produk, pr.harga_produk, pr.ket_produk
                from users_merchant as um 
                LEFT JOIN outlate as ot on um.id_merchant = ot.id_merchant
                LEFT JOIN m_kota as mkot on ot.id_kota  = mkot.id_kota
                LEFT JOIN m_kampus as mkm on  ot.id_kampus = mkm.id_kampus
                LEFT JOIN m_kategori as mkt on ot.id_kategori = mkt.id_kategori
                LEFT JOIN produk as pr on um.id_merchant = pr.id_merchant
                where um.id_merchant = '".$input['id']."'
            ";
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }
    public static function getOpenCloseToko($input) {
        
        $query = " 
                select 
                toc.hari_open, toc.jam_open, toc.menit_open,
                toc.jam_close, toc.menit_close
                from users_merchant as um 
                LEFT JOIN t_open_close_toko  as toc on um.id_merchant = toc.id_merchant
                where um.id_merchant = '".$input['id']."'
            ";
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }
    public static function getListImage($input) {
        
        $query = " 
                select  pi.name_image_produk
                from produk as p
                LEFT JOIN produk_image as pi on p.id_produk = pi.id_produk
                where p.id_produk = '".$input['id']."'
            ";
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }
}
