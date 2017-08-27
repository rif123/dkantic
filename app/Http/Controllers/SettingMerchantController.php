<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\kotaModel as Kota;
use App\models\kategoriModel as Kategori;
use App\models\kampusModel as Kampus;
use App\models\outlateModel;
use App\models\openCloseToko;

class SettingMerchantController extends Controller
{
    private $parser = [];
    private $id_merchant =  "";

    public function __construct() {
        $this->id_merchant = \Session::get('authMerchant.id_merchant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['label'] = "Setting Outlet";
        $this->parser['listKota'] = Kota::all()->toArray();
        $this->parser['listKategori'] = Kategori::all()->toArray();
        $dataConfig  = outlateModel::where('id_merchant', $this->id_merchant)->get()->toArray();

        $dataOpenCloseToko  = openCloseToko::where('id_merchant', $this->id_merchant)->get()->toArray();
        $this->parser['dataConfig'] = !empty($dataConfig[0]) ? $dataConfig[0] : "";
        $this->parser['listOpenCloseToko'] = $dataOpenCloseToko;
        return view('merchant.dashBoardMerchant.settingOutlet', $this->parser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKampus()
    {
        $input = Input::all();
        $rules = [
            "id_kota" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_kota.required"   => error_message('settingMessages.kota'),
            "_token.required"   => error_message('settingMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getKampus = Kampus::where('id_kota', $input['id_kota'])->get()->toArray(); 
            if (!empty($getKampus)) {
                $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => "", "message" => "",  "data" => $getKampus ]);
            } else {
                $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('settingMessages.kotaNotFound'), "data" => $getKampus ]);
            }

        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }   
        return response()->json($this->parser);
    }


    private function setCallback($data) {
        $this->parser['status'] = $data['status'];
        $this->parser['isRedirect'] = $data['isRedirect'];
        $this->parser['redirect'] = $data['redirect'];
        $this->parser['message'] = $data['message'];
        $this->parser['data'] = !empty($data['data']) ? $data['data'] : "";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doSaveConfig(Request $request)
    {
        $input = Input::all();
        $rules = [
            "id_kota" => "required",
            "id_kampus" => "required",
            "id_kategori" => "required",
            "nama_outlate" => "required",
            "nama_pemilik" => "required",
            "alamat_outlate" => "required",
            "hp_outlate" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_kota.required"   => error_message('settingMessages.kota'),
            "id_kampus.required"   => error_message('settingMessages.kampus'),
            "id_kategori.required"   => error_message('settingMessages.kategori'),
            "nama_outlate.required"   => error_message('settingMessages.nama_outlate'),
            "nama_pemilik.required"   => error_message('settingMessages.nama_pemilik'),
            "alamat_outlate.required"   => error_message('settingMessages.alamat_outlate'),
            "hp_outlate.required"   => error_message('settingMessages.hp_outlate'),
            "_token.required"   => error_message('settingMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            // delete before insert 
            $outlate = outlateModel::where('id_merchant', $this->id_merchant);
            $outlate->delete();

            // save outlate model
            $outlate = new outlateModel;
            $outlate->id_Kota = $request->id_kota;
            $outlate->id_kampus = $request->id_kampus;
            $outlate->id_kategori = $request->id_kategori;
            $outlate->id_merchant = $this->id_merchant; 
            $outlate->nama_outlate = $request->nama_outlate;
            $outlate->nama_pemilik_outlate = $request->nama_pemilik;
            $outlate->alamat_outlate = $request->alamat_outlate;
            $outlate->hp_outlate = $request->hp_outlate;
            $outlate->created = date('Y-m-d H:i:s');
            $outlate->creator = $this->id_merchant;
            $outlate->save();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('setting.outlate'), "message" => error_message('settingMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
       
    }


    public function doSaveOpenClose() {
        $input = Input::all();
        $rules = [
            "optionsCheckboxes" => "required",
            "open_jam_toko" => "required",
            "open_menit_toko" => "required",
            "close_jam_toko" => "required",
            "close_menit_toko" => "required",
            "_token" => "required"
        ];
        $messages = [
            "optionsCheckboxes.required"   => error_message('settingMessages.days'),
            "open_jam_toko.required"   => error_message('settingMessages.openajam'),
            "open_menit_toko.required"   => error_message('settingMessages.openamenit'),
            "close_jam_toko.required"   => error_message('settingMessages.closejam'),
            "close_menit_toko.required"   => error_message('settingMessages.closemenit'),
            "_token.required"   => error_message('settingMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getIdOutlate = outlateModel::where('id_merchant', $this->id_merchant)->get()->toArray();
            if (!empty($getIdOutlate)) {
                $idOutlate = $getIdOutlate[0]['id_outlate'];
                // delete before insert 
                $outlate = openCloseToko::where('id_outlate', $idOutlate);
                $outlate->delete();
                // save outlate model
                foreach($input['optionsCheckboxes'] as $key => $val) {
                    $openClose = new openCloseToko;
                    $openClose->id_outlate = $idOutlate;
                    $openClose->id_merchant = $this->id_merchant;
                    $openClose->hari_open = $val;
                    $openClose->jam_open = $input['open_jam_toko'];
                    $openClose->menit_open = $input['open_menit_toko'];
                    $openClose->jam_close = $input['close_jam_toko'];
                    $openClose->menit_close = $input['close_menit_toko'];
                    $openClose->save();
                }

                $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('setting.outlate'), "message" => error_message('settingMessages.success') ]);
            }
            
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
    public function doUpdateOpenToko() {
        $input = Input::all();
        $rules = [
            "status_open_outlate" => "required",
            "_token" => "required"
        ];
        $messages = [
            "status_open_outlate.required"   => error_message('settingMessages.openStatusOutlate'),
            "_token.required"   => error_message('settingMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            outlateModel::where('id_merchant', $this->id_merchant)->update( ['status_open_outlate' => $input['status_open_outlate'] ]);
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('setting.outlate'), "message" => error_message('settingMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('mainMerchant.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
}
