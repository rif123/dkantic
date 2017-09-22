<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\models\userCustomerModel as UserCustomer;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $id_customer =  "";
    private $parser =  [];
    public function __construct() {
        $this->id_customer = \Session::get('authCustomer.id_customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCustomer  = UserCustomer::where('id_customer', $this->id_customer)->get()->toArray();
        $this->parser['data'] = !empty($userCustomer[0]) ? $userCustomer[0] : "";
        return view("FE.profile.index", $this->parser);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doUpdateProfile()
    {
        $input = Input::all();
        $rules = [
            "nama_customer" => "required",
            "alamat_customer" => "required",
            "email_customer" => "required",
            "hp_customer" => "required",
            "pass_customer" => "required",
            "old_pass_customer" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_customer.required"   => error_message('MkampusMessages.nama_kampus'),
            "alamat_customer.required"   => error_message('MkampusMessages.id_kota'),
            "email_customer.required"   => error_message('MkampusMessages.id_kota'),
            "hp_customer.required"   => error_message('MkampusMessages.id_kota'),
            "pass_customer.required"   => error_message('MkampusMessages.id_kota'),
            "old_pass_customer.required"   => error_message('MkampusMessages.id_kota'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $userCustomer  = UserCustomer::where('id_customer', $this->id_customer)->get()->toArray();
            if ( !empty($userCustomer[0])) {
                if ($this->checkPassword($input, $userCustomer[0])) { 
                    unset($input['old_pass_customer']);
                    unset($input['_token']);
                    $input['pass_customer'] = Hash::make($input['pass_customer']);
                    UserCustomer::where('id_customer', $this->id_customer)->update($input);
                    $this->parser['data'] = !empty($userCustomer[0]) ? $userCustomer[0] : "";
                    $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('user.profile'), "message" => error_message('FEMessages.successUpdate') ]);
                } else {
                    $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('loginMessages.passwordFailed')]);   
                }
            }
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

    private function checkPassword($input, $hasedPass) {
        if(Hash::check($input['old_pass_customer'], $hasedPass['pass_customer']))
        {
            return true;
        }  
        return false;
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
