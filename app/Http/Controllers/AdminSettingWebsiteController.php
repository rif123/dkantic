<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\settingWebsiteModel as Site;


class AdminSettingWebsiteController extends Controller
{
    private $parser = [];
    private $id_merchant =  "";
    private $destinationPath = "";

    public function __construct() {
        $this->id_merchant = \Session::get('authMerchant.id_merchant');
        $this->destinationPath = base_path() . '/public/imageConfig';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['label'] = "Setting Website";
        $this->parser['dataConfig'] = !empty(Site::all()->toArray()[0]) ? Site::all()->toArray()[0] : [] ;
        return view('admin.dashBoardAdmin.settingWebSite', $this->parser);
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
            "telp_config" => "required",
            "_token" => "required"
        ];
        $messages = [
            "telp_config.required"   => error_message('settingWebSiteMessages.telp_config'),
            "_token.required"   => error_message('settingMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            if(Input::hasFile('favicon_config')){
                $files = $request->file('favicon_config');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $inputAdd['favicon_config'] =  $picture;
            }
            if(Input::hasFile('logo_fb_config')){
                $files = $request->file('logo_fb_config');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $inputAdd['logo_fb_config'] =  $picture;
            }
            if(Input::hasFile('logo_twit_config')){
                $files = $request->file('logo_twit_config');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $inputAdd['logo_twit_config'] =  $picture;
            }
            if(Input::hasFile('logo_gp_config')){
                $files = $request->file('logo_gp_config');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $inputAdd['logo_gp_config'] =  $picture;
            }
            $inputAdd['telp_config'] = $input['telp_config'];
            $inputAdd['fb_config'] = $input['fb_config'];
            $inputAdd['twit_config'] = $input['twit_config'];
            $inputAdd['gp_config'] = $input['gp_config'];
            $checkData = Site::all()->toArray();
            if (empty($checkData[0]['id_config'])) {
                DB::table('config')->insert($inputAdd);
            } else {
                DB::table('config')->where('id_config', $checkData[0]['id_config'])->update(array_filter($inputAdd));
            }
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('setting.website'), "message" => error_message('settingWebSiteMessage.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('setting.website'), "message" => $msg ]);
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
