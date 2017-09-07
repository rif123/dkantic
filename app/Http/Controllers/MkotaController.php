<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\kotaModel as Kota;

class MkotaController extends Controller
{
    private  $id_user_admin = "";
    private  $limit = 2;
    private  $offset = 0;

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
        $this->parser['label'] = "Master Kota";
        $this->parser['listKota'] = Kota::limit(1)->orderByDesc("id_kota")->get()->toArray();
        return view('admin.dashBoardAdmin.masterKota', $this->parser);
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
            "nama_kota" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_kota.required"   => error_message('MkotaMessages.nama_kota'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new Kota;
            $produkSave->nama_kota = $input['nama_kota'];
            $produkSave->created = date('Y-m-d H:i:s');
            $produkSave->creator = $this->id_user_admin;
            $produkSave->save();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKota.index'), "message" => error_message('MkotaMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKota.index'), "message" => $msg ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getKota()
    {   
        $input = Input::all();
        $draw   = $input['draw'];
        $length = $input['length'];
        $start  = $input['start'];
        $search = $input['search']["value"];
        $filter =  Input::get('search.value');
        // echo "<pre>";
        // print_R($filter);die;
        /**
            * set count
        **/
        // $whereData = array(array('name','test') , array('id' ,'!=','5')); 
        // $users = DB::table('users')->where($whereData)->get(); 
        //limit 
        $this->offset = $input['start'];

        $total = Kota::all();
        $result = Kota::take($this->limit);
        if (!empty($filter)) {
            $total =  Kota::where('nama_kota', 'like', '%' . $filter . '%');
            $result = $result->where('nama_kota', 'like', '%' . $filter . '%');
        }
        $total = $total->count();
        $result = $result->offset($this->offset)->get()->toArray();
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal'] = $output['recordsFiltered']=$total;
        $output['data']=array();
        
        
         /**
            * get all data
         **/
    
        $output['data']  = $result;
        return response()->json($output);
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
            "nama_kota" => "required",
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_kota.required"   => error_message('MkotaMessages.nama_kota'),
            "id.required"   => error_message('MkotaMessages.id_kota'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            Kota::where('id_kota', $input['id'])->update( ['nama_kota' => $input['nama_kota'] ]);
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKota.index'), "message" => error_message('MkotaMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKota.index'), "message" => $msg ]);
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
            "id.required"   => error_message('MkotaMessages.nama_kota'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $del = Kota::where('id_kota', $input['id']);
            $del->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKota.index'), "message" => error_message('MkotaMessages.successDelete') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKota.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
    
}
