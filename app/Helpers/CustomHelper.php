<?php 
use App\models\productMerchantImage as PRODIMG;
if (! function_exists('error_message')) {
    function error_message($feature) 
    {
        return config('messages.'.$feature);
    }
 }
if (! function_exists('get_menu_merchant')) {
    function get_menu_merchant() 
    {
        $listMenu = [
            [
                'icon' => 'dashboard',
                'link' => route('mainMerchant.index'),
                'label' => 'Dashboard'
            ],
            [
                'icon' => 'content_paste',
                'link' => route('setting.outlate'),
                'label' => 'Setting Outlate'
            ],
            [
                'icon' => 'storage',
                'link' => route('productMerchant.index'),
                'label' => 'Produk'
            ]
        ];
        return $listMenu;
    }
 }
if (! function_exists('get_menu_admin')) {
    function get_menu_admin() 
    {
        $listMenu = [
            [
                'icon' => 'dashboard',
                'link' => route('admindashboard.index'),
                'label' => 'Dashboard'
            ],
            [
                'icon' => 'content_paste',
                'link' => route('setting.website'),
                'label' => 'Setting Website'
            ],
            [
                'icon' => 'storage',
                'link' => route('masterAdmin.index'),
                'label' => 'Master'
            ],
            [
                'icon' => 'storage',
                'link' => route('promoLanding.index'),
                'label' => 'Promo'
            ],
            [
                'icon' => 'storage',
                'link' => route('manageAdmin.index'),
                'label' => 'Manage'
            ],
            [
                'icon' => 'storage',
                'link' => route('ProductAdmin.index'),
                'label' => 'Produk'
            ]
        ];
        return $listMenu;
    }
 }
if (! function_exists('get_list_days')) {
    function get_list_days() 
    {
        $listDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu' ];
        return $listDays;
    }
 }
if (! function_exists('getImageProd')) {
    function getImageProd($id_produk) {
        $listImage = PRODIMG::where('id_produk', $id_produk)->get()->toArray();
        return $listImage;
    }
}
if (! function_exists('numToRp')) {
    function numToRp($bilangan) {
        $minus = "";
        if ($bilangan < 0) {
            $minus = "-";
        }
        return $minus . 'Rp' . getThousandSeparator(abs($bilangan));
    }
}
if (! function_exists('getThousandSeparator')) {
    function getThousandSeparator($bilangan) {
        if (is_numeric($bilangan)) {
            return number_format($bilangan, 0, ',', '.');
        }
        return 0;
    }
}
