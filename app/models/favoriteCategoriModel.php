<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class favoriteCategoriModel extends Model
{
    public $timestamps = false;
    protected $table = 'favorite_kategori';
    protected $fillable = ['id_favorite_kategori', 'id_kategori', 'created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['fk.id_favorite_kategori', 'fk.id_kategori'];
    }

    public static function getFavorite() {
        $query = "
        select  fk.id_favorite_kategori, fk.id_kategori, mk.nama_kategori  from favorite_kategori as fk
        LEFT JOIN m_kategori as mk on fk.id_kategori = mk.id_kategori
        ";
        $listData = \DB::select($query);
        return json_decode(json_encode($listData), true);
    }
    public static function getAllData($input, $status) {
        $query = "
            select  fk.id_favorite_kategori, fk.id_kategori, mk.nama_kategori  from favorite_kategori as fk
            LEFT JOIN m_kategori as mk on fk.id_kategori = mk.id_kategori
            where 1=1
            ";
        
        if (!empty($input['search']['value'])) {
            $query .= " and mk.nama_kategori like  '%".$input['search']['value']."%' ";
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
