<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\PromoSlideModel as PromoSlide;
use App\models\PromoModel as Promo;
use App\models\favoriteCategoriModel as favoritePromo;

class FeMainMageController extends Controller
{
    private $parser = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $this->parser['listPromoBox'] = PromoSlide::all()->toArray();
        $this->parser['listPromo'] = Promo::all()->toArray();
        $this->parser['listFavorite'] = favoritePromo::getFavorite();
        return view('welcome', $this->parser);
    }
}
