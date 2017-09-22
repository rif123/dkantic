<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\productMerchant as Product;
use Storage;
use File;
use App\models\kampusModel as Kampus;
use App\models\kotaModel as Kota;
use App\models\userMerchant as UserMerchant;
use App\models\kategoriModel as Kategori;
use App\models\outlateModel as OutlateModel;
use App\models\productMerchantImage as PRODIMG;
use App\models\PromoSlideRoleModel as PromoSlide;
use App\models\PromoRoleModel as PromoRoleModel;

class ProductAdminController extends Controller
{
    private $parser = [];
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
         $this->parser['label'] = "Produk";
         $this->parser['listKota'] = Kota::all()->toArray();
         $this->parser['listKategori'] = Kategori::all()->toArray();
         return view('admin.dashBoardAdmin.produk', $this->parser);
     }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function listProduk()
     {
        $input = Input::all();
        $draw   = $input['draw'];
        /**
            * set count
        **/
        $result  = Product::getAllDataAdmin($input, true);
        $total = Product::getAllDataAdmin($input, false);
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
     public function formProduk()
     {
        $this->parser['listMerchant'] = userMerchant::all()->toArray();
        $res['status'] = true;
        $res['html'] = view('admin.dashBoardAdmin.product.formProduct', $this->parser)->render();
        return response()->json($res);
     }
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function formProdukSave(Request $request)
     {
        $input = Input::all();
        $rules = [
            "id_merchant" => "required",
            "nama_produk" => "required",
            "harga_produk" => "required",
            "ket_produk" => "required",
            "_token" => "required"
        ];

        $messages = [
            "id_merchant.required"   => error_message('MkampusMessages.id_merchant'),
            "nama_produk.required"   => error_message('MkampusMessages.nama_produk'),
            "harga_produk.required"   => error_message('MkampusMessages.harga_produk'),
            "ket_produk.required"   => error_message('MkampusMessages.ket_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new Product;
            $produkSave->id_merchant = $input['id_merchant'];
            $produkSave->nama_produk = $input['nama_produk'];
            $produkSave->ket_produk = $input['ket_produk'];
            $produkSave->created = date('Y-m-d H:i:s');
            $produkSave->creator = $this->id_user_admin;
            $produkSave->save();
            $insertedId = $produkSave->id;
            if(Input::hasFile('name_image_produk')){
                $files = $request->file('name_image_produk');
               foreach($files as $key => $val) {
                   $filename = $val->getClientOriginalName();
                   $extension = $val->getClientOriginalExtension();
                   $picture = date('His').$filename;
                   $destinationPath = base_path() . '/public/images';
                   $val->move($destinationPath, $picture);
                   $this->saveItemsProd($picture, $insertedId);
               }
           }  
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('ProductAdmin.index'), "message" => error_message('MkampusMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('ProductAdmin.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
     }

     private function saveItemsProd($filename, $insertedId) {
        $produkSave = new PRODIMG;
        $produkSave->name_image_produk = $filename;
        $produkSave->id_produk = $insertedId;
        return $produkSave->save();
        
    }

     private function setCallback($data) {
        $this->parser['status'] = $data['status'];
        $this->parser['isRedirect'] = $data['isRedirect'];
        $this->parser['redirect'] = $data['redirect'];
        $this->parser['message'] = $data['message'];
        $this->parser['data'] = !empty($data['data']) ? $data['data'] : "";
        $this->parser['dataImage'] = !empty($data['dataImage']) ? $data['dataImage'] : "";
    }

    
    public function showEdit () {
        $input = Input::all();
        $this->parser['listMerchant'] = userMerchant::all()->toArray();
        $this->parser['dataConfig'] = userMerchant::getProdByid($input['id']);
        $res['status'] = true;
        $res['html'] = view('admin.dashBoardAdmin.product.formUpdateProduct', $this->parser)->render();
        return response()->json($res);
    }
    
    
    public function formProdukUpdate (Request $request) {
        $input = Input::all();
        $rules = [
            "id_merchant" => "required",
            "nama_produk" => "required",
            "harga_produk" => "required",
            "ket_produk" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_merchant.required"   => error_message('MkampusMessages.id_merchant'),
            "nama_produk.required"   => error_message('MkampusMessages.nama_produk'),
            "harga_produk.required"   => error_message('MkampusMessages.harga_produk'),
            "ket_produk.required"   => error_message('MkampusMessages.ket_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
                $dataUpdate['nama_produk'] =  $input['nama_produk'];
                $dataUpdate['harga_produk'] =  $input['harga_produk'];
                $dataUpdate['ket_produk'] =  $input['ket_produk'];
                Product::where('id_produk', $input['id_produk'])->update($dataUpdate);
                $insertedId = $input['id_produk'];
                if(Input::hasFile('name_image_produk')){
                    $files = $request->file('name_image_produk');
                    foreach($files as $key => $val) {
                        $filename = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $picture = date('His').$filename;
                        $destinationPath = base_path() . '/public/images';
                        $val->move($destinationPath, $picture);
                        $this->saveItemsProd($picture, $insertedId);
                    }
                }
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('ProductAdmin.index'), "message" => error_message('MkampusMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('ProductAdmin.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
    

    public function deleteProd() {
        $input = Input::all();
        $rules = [
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id.required"   => error_message('produkMessages.id_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getListImage  = PRODIMG::where('id_produk', $input['id'])->get()->toArray();
            foreach ($getListImage as $key => $val) {
                $pathFile  = public_path('/images/').$val['name_image_produk'];
                if(File::exists($pathFile)) File::delete($pathFile);
            }
            PRODIMG::where('id_produk', $input['id'])->delete();
            PromoSlide::where('id_produk', $input['id'])->delete();
            PromoRoleModel::where('id_produk', $input['id'])->delete();
            Product::where('id_produk', $input['id'])->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('ProductAdmin.index'), "message" => error_message('produkMessages.successDeleteProd') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('ProductAdmin.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
    

    
}
