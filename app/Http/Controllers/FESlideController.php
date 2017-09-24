<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\kategoriModel as kategori;
use App\models\PromoSlideModel as PromoSlide;
use App\models\productMerchant as ProdukMerchant;

class FESlideController extends Controller
{
    private $parser = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['kategori'] = kategori::all()->toArray();
        $this->parser['listPromoBox'] = PromoSlide::all()->toArray();
        $this->parser['segment1'] = \Request::segment(2); 
        $this->parser['segment2'] = \Request::segment(3); 
        $this->parser['status']  = true;
        return view('FE.slider.slider', $this->parser);
    }
    public function getItems()
    {
        $input = Input::all();
        $page = Input::get('page', 1);
        $perPage = 3;
        $offset = ($page * $perPage) - $perPage;
        $input['id_kampus'] = \Request::segment(3); 

        $this->parser['listItems'] = ProdukMerchant::getDataByKampus($input, $offset, $perPage);
        $total = ProdukMerchant::getDataByKampusTotal($input);
        
        // config pagination
        $tpages = ($total) ? ceil($total/$perPage) : 1; 
        $this->parser['pageNumber'] =  ceil($total/$perPage);
        $this->parser['page'] = $page;
        $this->parser['input'] = $input;
        $html = view('FE.slider.listItems', $this->parser)->render();
        $res['html'] = $html;
        $res['page'] = $this->parser['page'];
        return response()->json($res);
    }
}
