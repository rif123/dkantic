<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\kampusModel as Kampus;
use App\models\kotaModel as Kota;
use App\models\merchantModel as Merchant;
use App\models\kategoriModel as Kategori;

class MmerchantController extends Controller
{
    private  $id_user_admin = "";
    public function __construct() {
        $this->id_user_admin = \Session::get('authAdmin.id_user_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['label'] = "Master Merchant"; 
        $this->parser['listKampus'] = Kampus::limit(1)->orderByDesc("id_kampus")->get()->toArray();
        $this->parser['listKota'] = Kota::all()->toArray();
        $this->parser['listKategori'] = Kategori::all()->toArray();
        return view('admin.dashBoardAdmin.masterMerchant', $this->parser);
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getMerchant()
     {   
         $input = Input::all();
         $draw   = $input['draw'];
         /**
             * set count
         **/
         $result  = Merchant::getAllData($input, true);
         
         $total = Merchant::getAllData($input, false);
         $output=array();
         $output['draw']=$draw;
         $output['recordsTotal'] = $output['recordsFiltered']= count($total);
         $output['data']=array();

          /**
             * get all data
          **/
         $output['data']  = $result;
         return response()->json($output);
     }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function filterMerchant()
     {   
         $input = Input::all();
         /**
             * set count
         **/
         $rules = [
            "_token" => "required"
        ];
        $messages = [
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $input = array_filter($input);
            unset($input['_token']);
            $result  = Merchant::getAllData($input, true);
        }
         
         return response()->json($output);
     }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getDetailMerchant()
     {   
         $input = Input::all();
         $rules = [
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id.required"   => error_message('MkampusMessages.id_merchant'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $listDetailToko  = Merchant::getDetailMerchant($input); 
            $listOpenCloseToko  = Merchant::getOpenCloseToko($input);
            $view = view('admin.dashBoardAdmin.merchant.detailMerchant', ['parser' => $listDetailToko, 'openCloseToko' => $listOpenCloseToko,  'listProduk' => ""])->render();
            $this->setCallback(['status' => true, 'isRedirect' => false, "redirect" => "", "message" => "", "data" => $view ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
     }
     
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getListImageProd()
     {   
         $input = Input::all();
         $rules = [
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id.required"   => error_message('MkampusMessages.id_merchant'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $listImageProduk  = Merchant::getListImage($input); 
            $this->setCallback(['status' => true, 'isRedirect' => false, "redirect" => "", "message" => "", "data" => $listImageProduk ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
     }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getKampus()
     {   
         $input = Input::all();
         $rules = [
            "id_kota" => "required",
        ];
        $messages = [
            "id.required"   => error_message('MkampusMessages.id_merchant')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $listKampus  = Kampus::where('id_kota', $input['id_kota'])->get()->toArray();
            $this->setCallback(['status' => true, 'isRedirect' => false, "redirect" => "", "message" => "", "data" => $listKampus ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
     }

     

     
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = Input::all();
        $rules = [
            "nama_kampus" => "required",
            "id_kota" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_kampus.required"   => error_message('MkampusMessages.nama_kampus'),
            "id_kota.required"   => error_message('MkampusMessages.id_kota'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new Kampus;
            $produkSave->nama_kampus = $input['nama_kampus'];
            $produkSave->id_kota = $input['id_kota'];
            $produkSave->created = date('Y-m-d H:i:s');
            $produkSave->creator = $this->id_user_admin;
            $produkSave->save();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKampus.index'), "message" => error_message('MkampusMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }


    private function setCallback($data) {
        $this->parser['status'] = $data['status'];
        $this->parser['isRedirect'] = $data['isRedirect'];
        $this->parser['redirect'] = $data['redirect'];
        $this->parser['message'] = $data['message'];
        $this->parser['data'] = !empty($data['data']) ? $data['data'] : "";
        $this->parser['dataImage'] = !empty($data['dataImage']) ? $data['dataImage'] : "";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update()
     {
        $input = Input::all();
        $rules = [
            "nama_kampus" => "required",
            "id_kota" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_kampus.required"   => error_message('MkampusMessages.nama_kampus'),
            "id_kota.required"   => error_message('MkampusMessages.id_kota'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
             Kampus::where('id_kampus', $input['id'])->update( [ 'nama_kampus' => $input['nama_kampus'], 'id_kota' => $input['id_kota'] ]);
             $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKampus.index'), "message" => error_message('MkampusMessages.successUpdate') ]);
         } else {
             $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('MkampusMessages.failedSave');
             $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
         }
         return response()->json($this->parser);
     }
    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        $input = Input::all();
        $rules = [
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id.required"   => error_message('MkampusMessages.id_kampus'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $del = Kampus::where('id_kampus', $input['id']);
            $del->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKampus.index'), "message" => error_message('MkampusMessages.successDelete') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('MkampusMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

}
