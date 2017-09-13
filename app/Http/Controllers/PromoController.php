<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\PromoModel as Promo;
use App\models\kampusModel as Kampus;
use App\models\kategoriModel as Kategori;
use App\models\outlateModel as Outlate;
class PromoController extends Controller
{
    private  $limit = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['label'] = "Promo";
        $this->parser['listPromo'] = $this->listPromo();
        $this->parser['listKampus'] = $this->listKampus();
        $this->parser['listKategori'] = $this->listKategori();
        $this->parser['listOutlate'] = $this->listOutlate();
        return view('admin.dashBoardAdmin.promo', $this->parser);
    }
    private function listPromo() {
        $list = Promo::take($this->limit)->orderBy('id_promo', 'desc')->get()->toArray();
        return $list;
    }
    private function listKampus() {
        $list = Kampus::take($this->limit)->orderBy('id_kampus', 'desc')->get()->toArray();
        return $list;
    }
    private function listKategori() {
        $list = Kategori::take($this->limit)->orderBy('id_kategori', 'desc')->get()->toArray();
        return $list;
    }
    private function listOutlate() {
        $list = Outlate::take($this->limit)->orderBy('id_outlate', 'desc')->get()->toArray();
        return $list;
    }
}
