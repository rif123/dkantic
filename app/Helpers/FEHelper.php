<?php 
use App\models\configModel;
use App\models\kotaModel;
if (! function_exists('menuConfig')) {
function menuConfig($param="") 
{
    \Session::forget('menuConfig');
    $getMenu  = \Session::get('menuConfig');
    if (empty($getMenu)) {
        $getMenu = configModel::all()->toArray();
        if (!empty($getMenu[0])) {
            \Session::put('menuConfig', $getMenu);
        }
    }
    if (!empty($param)) {
        return !empty($getMenu[0][$param]) ? $getMenu[0][$param] : "";
    } else {
        return $getMenu;
    }
}
}


if (! function_exists('listKota')) {
    function listKota() 
    {
        $query = " SELECT *, m_kota.id_kota as idKot FROM m_kota LEFT JOIN m_kampus on m_kota.id_kota = m_kampus.id_kota";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        $group = [];
        foreach($listData as $k => $v) {
            $group[$v['idKot']."||".$v['nama_kota']][]  = $v;
        }
        return $group;
    }
}

if (! function_exists('listProdByKategori')) {
    function listProdByKategori($id_kategori) 
    {
        $query = " 
            SELECT  pr.id_produk, pr.id_merchant, pr.nama_produk, pr.harga_produk, pr.ket_produk FROM produk as pr LEFT JOIN outlate as ot on ot.id_merchant = pr.id_merchant 
            where id_kategori = '".$id_kategori."'
        ";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        return $listData;
    }
}

if (! function_exists('listKategory')) {
    function listKategory() 
    {
        $query = "select * from m_kategori";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        return $listData;
    }
}

if (! function_exists('listGetImage')) {
    function listGetImage($id_produk) 
    {
        $query = " SELECT pr.id_produk, pi.id_image_produk, pi.name_image_produk FROM `produk` as pr LEFT JOIN produk_image as pi on pi.id_produk = pr.id_produk 
                    WHERE pr.id_produk  = '".$id_produk."'
        ";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        return $listData;
    }
}
if (! function_exists('listGetRatting')) {
    function listGetRatting($id_produk) 
    {
        $query = "SELECT  AVG(pr.rating_start) AS rating_average FROM produk_rating  as pr  where pr.id_produk = '".$id_produk."' ";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        return $listData;
    }
}

if (! function_exists('getCategori')) {
    function getCategori() 
    {
        $query = " SELECT * from m_kategori
        ";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        return $listData;
    }

}
if (! function_exists('listProdByPromo')) {
    function listProdByPromo($id_promo) 
    {
        $query = " SELECT p.id_promo, p.nama_promo, p.image_promo, pr.id_produk,  pr.id_produk,  pd.nama_produk, pd.harga_produk, pd.ket_produk  FROM `promo` as p LEFT JOIN promo_role as pr on pr.id_promo = p.id_promo LEFT JOIN produk as pd on pr.id_produk = pd.id_produk 
        where pr.id_promo = '".$id_promo."' ";
        $listData = \DB::select($query);
        $listData  = json_decode(json_encode($listData), true);
        return $listData;
    }
}


if (! function_exists('convertRp')) {
    function convertRp($number) 
    {
        if(!empty($number)) {
            $rp = number_format($number, 0, ".", ".");
            return "Rp. ".$rp;
        }
    }
}
if (! function_exists('toSlug')) {
    function toSlug($string) 
    {
        $url = str_slug($string, '-');
        return $url;
    }
}
if (! function_exists('paginate_one')) {
    function paginate_one($reload, $page, $tpages) 
    {
        $firstlabel = "&laquo;&nbsp;";
        $prevlabel  = "&lsaquo;&nbsp;";
        $nextlabel  = "&nbsp;&rsaquo;";
        $lastlabel  = "&nbsp;&raquo;";
        
        $out = "<ul class=\"pagination\">";
        
        // first
        if($page>1) {
            $out.= "<li><a href=\"" . $reload . "\">" . $firstlabel . "</a></li>";
        }
        else {
            $out.= "<li><span>" . $firstlabel . "</span></li>";
        }
        
        // previous
        if($page==1) {
            $out.= "<li><span>" . $prevlabel . "</span></li>";
        }
        elseif($page==2) {
            $out.= "<li><a href=\"" . $reload . "\">" . $prevlabel . "</a></li>";
        }
        else {
            $out.= "<li><a href=\"" . $reload . "\"  data-page='".($page-1)."' >" . $prevlabel . "</a></li>";
        }
        
        // current
        $out.= "<li><span class=\"current\">Page " . $page . " of " . $tpages ."</span></li>";
        
        // next
        if($page<$tpages) {
            $out.= "<li><a  href='$reload' data-page='".($page+1)."' >" . $nextlabel . "</a></li>";
        }
        else {
            $out.= "<li><span>" . $nextlabel . "</span></li>";
        }
        
        // last
        if($page<$tpages) {
            $out.= "<li><a  href='$reload'  data-page='".$tpages."' >" . $lastlabel . "</a></li>";
        }
        else {
            $out.= "<li><span>" . $lastlabel . "</span></li>";
        }
        
        $out.= "</ul>";
        
        return $out;
    }
}