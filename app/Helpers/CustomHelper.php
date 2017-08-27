<?php 
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
if (! function_exists('get_list_days')) {
    function get_list_days() 
    {
        $listDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu' ];
        return $listDays;
    }
 }
