<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
class kampusModel extends Model
{
    public $timestamps = false;
    protected $table = 'm_kampus';
    protected $fillable = ['id_kampus', 'nama_kampus', 'id_kota',  'created', 'creator', 'edited', 'editor'];
    public static function column_order()
    {
        return  ['id_kampus', 'nama_kampus', 'nama_kota'];
    }
    public static function getAllData($input, $status) {

        $query = "
            select mk.id_kampus, mk.id_kota, mk.nama_kampus, kot.nama_kota from m_kampus as mk 
            LEFT JOIN m_kota as kot on mk.id_kota  = kot.id_kota
            where 1=1
            ";
        
        if (!empty($input['search']['value'])) {
            $query .= " and nama_kampus like  '%".$input['search']['value']."%' ";
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
