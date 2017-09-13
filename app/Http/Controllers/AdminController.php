<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\models\userAdminModel as Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login.loginView');
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
            "username_admin" => "required",
            "password_admin" => "required",
            "_token" => "required"
        ];
        $messages = [
            "username_admin.required"   => error_message('loginMessages.username'),
            "password_admin.required"   => error_message('loginMessages.password'),
            "_token.required"   => error_message('loginMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $query = Admin::where('username_admin', $input['username_admin'])->get();
            $user = $query->toArray();
            if (!empty($user)) {
                $check = $this->checkPassword($input, $user[0]);
                if ($check){
                    $this->setSessionLogin($user[0]);
                    $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('admindashboard.index'), "message" => error_message('loginMessages.success')]);
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
    public function destroy() {
        \Session::forget('authAdmin');
        return redirect(route('admin.index'));
    }
    private function checkPassword($input, $hasedPass) {
        if(Hash::check($input['password_admin'], $hasedPass['password_admin']))
        {
            return true;
        }  
        return false;
    }
    private function setSessionLogin($user) {
        $userPut = [
             'id_user_admin' => $user['id_user_admin'],
             'username_merchant' => $user['username_admin'],
             'password_admin' => $user['password_admin'],
             'created' => $user['created'],
             'creator' => $user['creator']
        ];
        \Session()->put('authAdmin', $userPut);
        \Session::save();
        return true;
     }
 
     private function setCallback($data) {
         $this->parser['status'] = $data['status'];
         $this->parser['isRedirect'] = $data['isRedirect'];
         $this->parser['redirect'] = $data['redirect'];
         $this->parser['message'] = $data['message'];
     }
     
}
