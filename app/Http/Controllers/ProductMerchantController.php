<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\models\productMerchant as PROD;
use App\models\productMerchantImage as PRODIMG;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class ProductMerchantController extends Controller
{
    private $parser = [];
    private $id_merchant =  "";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->id_merchant = \Session::get('authMerchant.id_merchant');
    }

    public function index()
    {
        $this->parser['label'] = "Produk ";
        $this->parser['listProduk'] = PROD::all()->toArray();
        return view('merchant.dashBoardMerchant.productMerchant', $this->parser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $rules = [
            "nama_produk" => "required",
            "harga_produk" => "required",
            "ket_produk" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_produk.required"   => error_message('produkMessages.nama_produk'),
            "harga_produk.required"   => error_message('produkMessages.harga_produk'),
            "ket_produk.required"   => error_message('produkMessages.ket_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new PROD;
            $produkSave->nama_produk = $input['nama_produk'];
            $produkSave->harga_produk = $input['harga_produk'];
            $produkSave->ket_produk = $input['ket_produk'];
            $produkSave->id_merchant = $this->id_merchant;
            $produkSave->save();
            $insertedId = $produkSave->id;
            if(Input::hasFile('name_image_prod')){
                 $files = $request->file('name_image_prod');
                foreach($files as $key => $val) {
                    $filename = $val->getClientOriginalName();
                    $extension = $val->getClientOriginalExtension();
                    $picture = date('His').$filename;
                    $destinationPath = base_path() . '/public/images';
                    $val->move($destinationPath, $picture);
                    $this->saveItemsProd($picture, $insertedId);
                }
            }
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('productMerchant.index'), "message" => error_message('produkMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request)
     {
         $input = Input::all();
         $rules = [
             "nama_produk" => "required",
             "harga_produk" => "required",
             "ket_produk" => "required",
             "id_produk" => "required",
             "_token" => "required"
         ];
         $messages = [
             "nama_produk.required"   => error_message('produkMessages.nama_produk'),
             "harga_produk.required"   => error_message('produkMessages.harga_produk'),
             "ket_produk.required"   => error_message('produkMessages.ket_produk'),
             "id_produk.required"   => error_message('produkMessages.id_produk'),
             "_token.required"   => error_message('produkMessages._token')
         ];
         $validator = Validator::make($input, $rules, $messages);
         if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
             $dataUpdate['nama_produk'] =  $input['nama_produk'];
             $dataUpdate['harga_produk'] =  $input['harga_produk'];
             $dataUpdate['ket_produk'] =  $input['ket_produk'];
             PROD::where('id_produk', $input['id_produk'])
                    ->update($dataUpdate);

             $insertedId = $input['id_produk'];
             if(Input::hasFile('name_image_prod')){
                  $files = $request->file('name_image_prod');
                 foreach($files as $key => $val) {
                     $filename = $val->getClientOriginalName();
                     $extension = $val->getClientOriginalExtension();
                     $picture = date('His').$filename;
                     $destinationPath = base_path() . '/public/images';
                     $val->move($destinationPath, $picture);
                     $this->saveItemsProd($picture, $insertedId);
                 }
             }
             $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('productMerchant.index'), "message" => error_message('produkMessages.success') ]);
         } else {
             $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
             $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
         }
         return response()->json($this->parser);
     }

     
    public function deleteProd() {
        $input = Input::all();
        $rules = [
            "id_produk" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_produk.required"   => error_message('produkMessages.id_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getListImage  = PRODIMG::where('id_produk', $input['id_produk'])->get()->toArray();
            foreach ($getListImage as $key => $val) {
                $pathFile  = public_path('/images/').$val['name_image_produk'];
                if(File::exists($pathFile)) File::delete($pathFile);
            }
            PRODIMG::where('id_produk', $input['id_produk'])->delete();
            PROD::where('id_produk', $input['id_produk'])->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('productMerchant.index'), "message" => error_message('produkMessages.successDeleteProd') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
     
    public function preview() {
        $input = Input::all();
        $rules = [
            "id_produk" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_produk.required"   => error_message('produkMessages.id_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getData = PROD::where('id_produk', $input['id_produk'])->get()->toArray();
            $this->parser['dataProduk'] = !empty($getData[0]) ? $getData[0] : "";
            $view =  view('merchant.dashBoardMerchant.product.previewProduk', $this->parser)->render();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('productMerchant.index'), "message" => error_message('produkMessages.success'), "data" => $view ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

    public function update() {
        $input = Input::all();
        $rules = [
            "id_produk" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_produk.required"   => error_message('produkMessages.id_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getData = PROD::where('id_produk', $input['id_produk'])->get()->toArray();
            $data = !empty($getData[0]) ? $getData[0] : "";
            $getImageData = PRODIMG::where('id_produk', $input['id_produk'])->get()->toArray();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('productMerchant.index'), "message" => error_message('produkMessages.success'), "data" => $data, "dataImage" => $getImageData ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

    public function deleteImage() {
        $input = Input::all();
        $rules = [
            "id_image_produk" => "required",
            "name_image_produk" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_image_produk.required"   => error_message('produkMessages.id_image_produk'),
            "name_image_produk.required"   => error_message('produkMessages.id_image_produk'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            PRODIMG::where('id_image_produk', $input['id_image_produk'])->delete();
            $pathFile  = public_path('/images/').$input['name_image_produk'];
            if(File::exists($pathFile)) File::delete($pathFile);
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('productMerchant.index'), "message" => error_message('produkMessages.successDeleteImage') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
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

  

}
