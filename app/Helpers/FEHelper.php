<?php 
use App\models\configModel;
if (! function_exists('menuConfig')) {
    function menuConfig($param="") 
    {
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