<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\models\userCustomerModel as UserCustomer;
use App\Mail\KryptoniteFound;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    private  $id_customer = "";
    public function __construct() {
        $this->id_customer = \Session::get('auth.id_customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return  view('FE.login.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doReg()
    {
      
        $input = Input::all();
        $rules = [
            "nama_customer" => "required",
            "alamat_customer" => "required",
            "pass_customer" => "required",
            "email_customer" => "required",
            "hp_customer" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_customer.required"   => error_message('FEMessages.nama_customer'),
            "pass_customer.required"   => error_message('FEMessages.pass_customer'),
            "alamat_customer.required"   => error_message('FEMessages.alamat_customer'),
            "email_customer.required"   => error_message('FEMessages.email_customer'),
            "hp_customer.required"   => error_message('FEMessages.hp_customer'),
            "_token.required"   => error_message('FEMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $query = UserCustomer::where('nama_customer', $input['nama_customer'])->get();
            $user = $query->toArray();
            if (empty($user)) {
                    $loginSave = new UserCustomer;
                    $loginSave->nama_customer = $input['nama_customer'];
                    $loginSave->pass_customer = Hash::make($input['pass_customer']);
                    $loginSave->alamat_customer = $input['alamat_customer'];
                    $loginSave->email_customer = $input['email_customer'];
                    $loginSave->hp_customer = $input['hp_customer'];
                    $loginSave->created = date('Y-m-d H:i:s');
                    $loginSave->creator =  $this->id_customer;

                    $loginSave->save();
                    $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('user.login'), "message" => error_message('FEMessages.successSave') ]);
            } else { 
                $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('FEMessages.loginAlreadyExist')]);
            }
         } else {
             $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('FEMessages.failedSave');
             $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
         }
         return response()->json($this->parser);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doLogin()
    {
        $input = Input::all();
        $rules = [
            "nama_customer" => "required",
            "pass_customer" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_customer.required"   => error_message('FEMessages.nama_customer'),
            "pass_customer.required"   => error_message('FEMessages.pass_customer'),
            "_token.required"   => error_message('FEMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $query = UserCustomer::where('nama_customer', $input['nama_customer'])->get();
            $user = $query->toArray();
            if (!empty($user)) {
                $check = $this->checkPassword($input, $user[0]);
                if ($check){
                    $this->setSessionLogin($user[0]);
                    $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('user.login'), "message" => error_message('FEMessages.successSave') ]);
                } else {
                    $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('loginMessages.passwordFailed')]);
                }
            } else { 
                $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('loginMessages.passwordFailed')]);
            }
         } else {
             $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('FEMessages.failedSave');
             $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKampus.index'), "message" => $msg ]);
         }
         return response()->json($this->parser);
    }

    public function doLogout() {
        \Session::forget('authCustomer');
        return redirect(route('fe.index'));
    }

    public function showForgotPassword() {
        // Mail::to('rifky@kudo.co.id')->send(new KryptoniteFound);
        return  view('FE.login.forgotPassword');
    }

    public function doForgotPassword() {
        $input = Input::all();
        $rules = [
            "email_customer" => "required",
            "_token" => "required"
        ];
        $messages = [
            "email_customer.required"   => error_message('FEMessages.email_customer'),
            "_token.required"   => error_message('FEMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $getCustomer = UserCustomer::where('email_customer', $input['email_customer'])->get()->toArray();
            if (empty($getCustomer)) {
                $this->setCallback(['status' => false, 'isRedirect' => true, "redirect" => route('user.showForgotPassword'), "message" => "User Tidak di temukan" ]);
            } else {

                $this->setCallback(['status' => false, 'isRedirect' => true, "redirect" => route('user.showForgotPassword'), "message" => "Silahkan Cek email" ]);
            }
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('FEMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('user.showForgotPassword'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }



    private function checkPassword($input, $hasedPass) {
        if(Hash::check($input['pass_customer'], $hasedPass['pass_customer']))
        {
            return true;
        }  
        return false;
    }
    private function setSessionLogin($user) {
        $userPut = [
             'id_customer' => $user['id_customer'],
             'alamat_customer' => $user['alamat_customer'],
             'nama_customer' => $user['nama_customer'],
             'email_customer' => $user['email_customer'],
             'hp_customer' => $user['hp_customer'],
             'created' => $user['created'],
             'creator' => $user['creator']
        ];
        \Session()->put('authCustomer', $userPut);
        \Session::save();
        return true;
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
