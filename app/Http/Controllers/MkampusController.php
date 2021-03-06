<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\kampusModel as Kampus;
use App\models\kotaModel as Kota;
class MkampusController extends Controller
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
        $this->parser['label'] = "Master Kota";
        $this->parser['listKampus'] = Kampus::limit(1)->orderByDesc("id_kampus")->get()->toArray();
        $this->parser['listKota'] = Kota::all()->toArray();
        return view('admin.dashBoardAdmin.masterKampus', $this->parser);
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getkampus()
     {   
         $input = Input::all();
         $draw   = $input['draw'];
         /**
             * set count
         **/
         $result  = Kampus::getAllData($input, true);
         
         $total = Kampus::getAllData($input, false);
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
