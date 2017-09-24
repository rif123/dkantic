<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class productMerchant extends Model
{
    public $timestamps = false;
    protected $table = 'produk';
    protected $fillable = ['id_produk', 'id_merchant', 'nama_produk','ket_produk','img_produk', 'created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['id_merchant', 'username_merchant', 'nama_kota', 'nama_kampus', 'nama_kategori', 'nama_outlate', 'nama_pemilik_outlate', 'alamat_outlate', 'hp_outlate', 'status_open_outlate'];
    }
    public static function getAllDataAdmin($input, $status) {
                $query = " 
                        select um.id_merchant, um.username_merchant, um.pass_merchant, 
                            mkot.nama_kota, mkm.nama_kampus,mkt.nama_kategori,
                            ot.id_kota, ot.id_kampus, ot.id_kategori, ot.nama_outlate, 
                            ot.nama_pemilik_outlate, ot.alamat_outlate, ot.hp_outlate, 
                            ot.status_open_outlate,prd.id_produk, prd.nama_produk, prd.harga_produk
                        from users_merchant as um 
                        LEFT JOIN outlate as ot on um.id_merchant = ot.id_merchant
                        LEFT JOIN m_kota as mkot on ot.id_kota  = mkot.id_kota
                        LEFT JOIN m_kampus as mkm on  ot.id_kampus = mkm.id_kampus
                        LEFT JOIN m_kategori as mkt on ot.id_kategori = mkt.id_kategori
                        LEFT JOIN produk as prd on prd.id_merchant = um.id_merchant
                        where prd.id_produk != ''
                    ";
                if (!empty($input['status_open_outlate'])) {
                    $query .= " AND ot.status_open_outlate like '%".$input['status_open_outlate']."%' ";
                }
                if (!empty($input['username_merchant'])) {
                    $query .= " AND um.username_merchant like '%".$input['username_merchant']."%' ";
                }
                if (!empty($input['id_kota'])) {
                    $query .= " AND ot.id_kota like '%".$input['id_kota']."%' ";
                }
                if (!empty($input['id_kampus'])) {
                    $query .= " AND ot.id_kampus like '%".$input['id_kampus']."%' ";
                }
                if (!empty($input['id_kategori'])) {
                    $query .= " AND ot.id_kategori like '%".$input['id_kategori']."%' ";
                }
                if (!empty($input['nama_kategori'])) {
                    $query .= " AND mkt.nama_kategori like '%".$input['nama_kategori']."%' ";
                }
                if (!empty($input['nama_outlate'])) {
                    $query .= " AND ot.nama_outlate like '%".$input['nama_outlate']."%' ";
                }
                if (!empty($input['nama_pemilik_outlate'])) {
                    $query .= " AND ot.nama_pemilik_outlate like '%".$input['nama_pemilik_outlate']."%' ";
                }
                if (!empty($input['alamat_outlate'])) {
                    $query .= " AND ot.alamat_outlate like '%".$input['alamat_outlate']."%' ";
                }
                if (!empty($input['hp_outlate'])) {
                    $query .= " AND ot.hp_outlate like '%".$input['hp_outlate']."%' ";
                }
                if (!empty($input['nama_produk'])) {
                    $query .= " AND prd.nama_produk like '%".$input['nama_produk']."%' ";
                }
                if (!empty($input['harga_produk'])) {
                    $query .= " AND prd.harga_produk like '%".$input['harga_produk']."%' ";
                }
                if (!empty($input['status_open_outlate'])) {
                    $query .= " AND ot.status_open_outlate like '%".$input['status_open_outlate']."%' ";
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


    public static function getDataByKampus($input, $offset=0, $perpage=1) {
        $query  = self::queryProcess();
        if (!empty($input['status_open_outlate'])) {
            $query .= " AND ot.status_open_outlate like '%".$input['status_open_outlate']."%' ";
        }
        if (!empty($input['username_merchant'])) {
            $query .= " AND um.username_merchant like '%".$input['username_merchant']."%' ";
        }
        if (!empty($input['id_kota'])) {
            $query .= " AND ot.id_kota like '%".$input['id_kota']."%' ";
        }
      
        if (!empty($input['nama_kategori'])) {
            $query .= " AND mkt.nama_kategori like '%".$input['nama_kategori']."%' ";
        }
        if (!empty($input['nama_outlate'])) {
            $query .= " AND ot.nama_outlate like '%".$input['nama_outlate']."%' ";
        }
        if (!empty($input['nama_pemilik_outlate'])) {
            $query .= " AND ot.nama_pemilik_outlate like '%".$input['nama_pemilik_outlate']."%' ";
        }
        if (!empty($input['alamat_outlate'])) {
            $query .= " AND ot.alamat_outlate like '%".$input['alamat_outlate']."%' ";
        }
        if (!empty($input['hp_outlate'])) {
            $query .= " AND ot.hp_outlate like '%".$input['hp_outlate']."%' ";
        }
        if (!empty($input['nama_produk'])) {
            $query .= " AND prd.nama_produk like '%".$input['nama_produk']."%' ";
        }
        if (!empty($input['harga_produk'])) {
            $query .= " AND prd.harga_produk like '%".$input['harga_produk']."%' ";
        }
        if (!empty($input['status_open_outlate'])) {
            $query .= " AND ot.status_open_outlate like '%".$input['status_open_outlate']."%' ";
        }

        
        if (!empty($input['id_kampus'])) {
            $query .= " AND o.id_kampus like '%".$input['id_kampus']."%' ";
        }

        if (!empty($input['hargaStart']) && !empty($input['hargaEnd']) ) {
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaStart']) && empty($input['hargaEnd']))  {
            if (empty($input['hargaEnd']))  {
                $input['hargaEnd'] =  $input['hargaStart'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaEnd']) && empty($input['hargaStart']))  {
            if (empty($input['hargaStart']))  {
                $input['hargaStart'] =  $input['hargaEnd'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }

        if (!empty($input['id_kategori'])) {
            if (is_array($input['id_kategori']) ) {
                foreach($input['id_kategori'] as $key => $val) {
                    $query .= " AND o.id_kategori like '%".$val."%' ";
                }
            } else {
                $query .= " AND o.id_kategori like '%".$input['id_kategori']."%' ";
            }
        }

        if (!empty($input['orderBY'])) {
            if ($input['orderBY'] == 'priceAsc') {
                $query .= " ORDER BY   pr.harga_produk  ASC";
            }
            if ($input['orderBY'] == 'priceDesc') {
                $query .= " ORDER BY  pr.harga_produk DESC";
            }
        }

       
        $query .= " LIMIT ".$offset.",".$perpage;
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }

    public static function getDataByKampusTotal($input) {
        $query  = self::queryProcess();
        if (!empty($input['status_open_outlate'])) {
            $query .= " AND ot.status_open_outlate like '%".$input['status_open_outlate']."%' ";
        }
        if (!empty($input['username_merchant'])) {
            $query .= " AND um.username_merchant like '%".$input['username_merchant']."%' ";
        }
        if (!empty($input['id_kota'])) {
            $query .= " AND ot.id_kota like '%".$input['id_kota']."%' ";
        }
        if (!empty($input['nama_kategori'])) {
            $query .= " AND mkt.nama_kategori like '%".$input['nama_kategori']."%' ";
        }
        if (!empty($input['nama_outlate'])) {
            $query .= " AND ot.nama_outlate like '%".$input['nama_outlate']."%' ";
        }
        if (!empty($input['nama_pemilik_outlate'])) {
            $query .= " AND ot.nama_pemilik_outlate like '%".$input['nama_pemilik_outlate']."%' ";
        }
        if (!empty($input['alamat_outlate'])) {
            $query .= " AND ot.alamat_outlate like '%".$input['alamat_outlate']."%' ";
        }
        if (!empty($input['hp_outlate'])) {
            $query .= " AND ot.hp_outlate like '%".$input['hp_outlate']."%' ";
        }
        if (!empty($input['nama_produk'])) {
            $query .= " AND prd.nama_produk like '%".$input['nama_produk']."%' ";
        }
        if (!empty($input['harga_produk'])) {
            $query .= " AND prd.harga_produk like '%".$input['harga_produk']."%' ";
        }
        if (!empty($input['status_open_outlate'])) {
            $query .= " AND ot.status_open_outlate like '%".$input['status_open_outlate']."%' ";
        }



        if (!empty($input['id_kampus'])) {
            $query .= " AND o.id_kampus like '%".$input['id_kampus']."%' ";
        }

        if (!empty($input['hargaStart']) && !empty($input['hargaEnd']) ) {
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaStart']) && empty($input['hargaEnd']))  {
            if (empty($input['hargaEnd']))  {
                $input['hargaEnd'] =  $input['hargaStart'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaEnd']) && empty($input['hargaStart']))  {
            if (empty($input['hargaStart']))  {
                $input['hargaStart'] =  $input['hargaEnd'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }

        if (!empty($input['id_kategori'])) {
            if (is_array($input['id_kategori']) ) {
                foreach($input['id_kategori'] as $key => $val) {
                    $query .= " AND o.id_kategori like '%".$val."%' ";
                }
            } else {
                $query .= " AND o.id_kategori like '%".$input['id_kategori']."%' ";
            }
        }

        $listData = \DB::select($query);
        $alldata = json_decode(json_encode($listData), true);
        return count($alldata);
    }
    public static function queryProcess() {
        $query = " 
            select 
            pr.id_produk, pr.id_merchant, pr.nama_produk, pr.harga_produk,
            o.id_kampus, o.nama_outlate
            from produk as pr 
            LEFT JOIN outlate as o on pr.id_merchant = o.id_merchant 
            LEFT JOIN m_kota as mk on o.id_kampus = mk.id_kota
            where pr.id_produk != ''
        ";
        return $query;
    }




    // promo
    private static function queryPromo() {
        $q = "SELECT p.id_produk, p.id_promo, pr.id_merchant, pr.nama_produk, pr.nama_produk, pr.ket_produk, pr.harga_produk, prm.nama_promo,o.id_kategori
        FROM `promo_role` as p 
        LEFT JOIN produk as pr on pr.id_produk = p.id_produk
        LEFT JOIN promo as prm on p.id_promo = prm.id_promo
        LEFT JOIN outlate as o on o.id_merchant = pr.id_merchant
        WHERE 1=1 
        ";
        return $q;
    }

    public static function getDataByPromo($input, $offset=0, $perpage=1) {
        $query  = self::queryPromo();
        if (!empty($input['id_promo'])) {
            $query .= " AND p.id_promo = ".$input['id_promo'];
        }

        if (!empty($input['hargaStart']) && !empty($input['hargaEnd']) ) {
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaStart']) && empty($input['hargaEnd']))  {
            if (empty($input['hargaEnd']))  {
                $input['hargaEnd'] =  $input['hargaStart'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaEnd']) && empty($input['hargaStart']))  {
            if (empty($input['hargaStart']))  {
                $input['hargaStart'] =  $input['hargaEnd'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }

        if (!empty($input['id_kategori'])) {
            if (is_array($input['id_kategori']) ) {
                foreach($input['id_kategori'] as $key => $val) {
                    $query .= " AND o.id_kategori = ".$val;
                }
            } else {
                $query .= " AND o.id_kategori = ".$input['id_kategori'];
            }
        }

        if (!empty($input['orderBY'])) {
            if ($input['orderBY'] == 'priceAsc') {
                $query .= " ORDER BY   pr.harga_produk  ASC";
            }
            if ($input['orderBY'] == 'priceDesc') {
                $query .= " ORDER BY  pr.harga_produk DESC";
            }
        }
        $query .= " LIMIT ".$offset.",".$perpage;
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }

    public static function getDataByPromoTotal($input) {
        $query  = self::queryPromo();
        if (!empty($input['id_promo'])) {
            $query .= " AND p.id_promo like '%".$input['id_promo']."%' ";
        }

        if (!empty($input['hargaStart']) && !empty($input['hargaEnd']) ) {
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaStart']) && empty($input['hargaEnd']))  {
            if (empty($input['hargaEnd']))  {
                $input['hargaEnd'] =  $input['hargaStart'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }
        if (!empty($input['hargaEnd']) && empty($input['hargaStart']))  {
            if (empty($input['hargaStart']))  {
                $input['hargaStart'] =  $input['hargaEnd'] + 1;
            }
            $query .= " AND pr.harga_produk >= ".$input['hargaStart']." AND pr.harga_produk <= ".$input['hargaEnd'];
        }

        if (!empty($input['id_kategori'])) {
            if (is_array($input['id_kategori']) ) {
                foreach($input['id_kategori'] as $key => $val) {
                    $query .= " AND o.id_kategori like '%".$val."%' ";
                }
            } else {
                $query .= " AND o.id_kategori like '%".$input['id_kategori']."%' ";
            }
        }
        $listData = \DB::select($query);
        $alldata = json_decode(json_encode($listData), true);
        return count($alldata);
    }
   

}
