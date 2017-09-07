<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kategoriModel extends Model
{
    public $timestamps = false;
    protected $table = 'm_kategori';
    protected $fillable = ['id_kategori', 'nama_kategori','created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['id_kategori', 'nama_kategori'];
    }
    public static function getAllData($input, $status) {
        $query = "
            select  id_kategori,nama_kategori  from m_kategori
            where 1=1
            ";
        
        if (!empty($input['search']['value'])) {
            $query .= " and nama_kategori like  '%".$input['search']['value']."%' ";
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
