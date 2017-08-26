<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\models\userMerchant as user;
use Auth;
class MerchantController extends Controller
{
    private $parser = [];
    protected $password = "";
    protected $username = "";
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchant.login.loginMerchant');
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
            "username" => "required",
            "password" => "required",
            "_token" => "required"
        ];
        $messages = [
            "username.required"   => error_message('loginMessages.username'),
            "password.required"   => error_message('loginMessages.password'),
            "_token.required"   => error_message('loginMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $query = user::where('username_merchant', $input['username'])->get();
            $user = $query->toArray();
            if (!empty($user)) {
                $check = $this->checkPassword($input, $user[0]);
                if ($check){
                    $this->setSessionLogin($user[0]);
                    $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('mainMerchant.index'), "message" => error_message('loginMessages.success')]);
                } else {
                    $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('loginMessages.passwordFailed')]);
                }
            } else {
                $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => error_message('loginMessages.loginFailed')]);
            }
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('loginMessages.loginFailed');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => "", "message" => $msg]);
        }
        return response()->json($this->parser);
    }

    private function checkPassword($input, $hasedPass) {
        if(Hash::check($input['password'], $hasedPass['pass_merchant']))
        {
            return true;
        }  
        return false;
    }

    
    private function setSessionLogin($user) {
       $userPut = [
            'id_merchant' => $user['id_merchant'],
            'username_merchant' => $user['username_merchant'],
            'pass_merchant' => $user['pass_merchant'],
            'created' => $user['created'],
            'creator' => $user['creator']
       ];
       \Session()->put('authMerchant', $userPut);
       \Session::save();
       return true;
    }

    private function setCallback($data) {
        $this->parser['status'] = $data['status'];
        $this->parser['isRedirect'] = $data['isRedirect'];
        $this->parser['redirect'] = $data['redirect'];
        $this->parser['message'] = $data['message'];
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        \Session()->forget('authMerchant');
        return redirect('merchant/login ');
    }
}
