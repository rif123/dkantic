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
            ]
        ];
        return $listMenu;
    }
 }
