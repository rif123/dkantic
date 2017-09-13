<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\PromoModel as Promo;
use App\models\outlateModel as Outlate;
use App\models\PromoRoleModel as PromoRole;
use App\models\productMerchant as Produk;

class PromoOriginController extends Controller
{

    private  $id_user_admin = "";
    private  $limit = 2;
    private  $offset = 0;
    private $destinationPath = "";
    public function __construct() {
        $this->id_user_admin = \Session::get('authAdmin.id_user_admin');
        $this->destinationPath = base_path() . '/public/imagePromo';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['label'] = "Promo";
        $this->parser['listPromo'] = Promo::all()->toArray();
        return view('admin.dashBoardAdmin.promoOrigin', $this->parser);
    }

    public function getPromo() {
        $input = Input::all();
        $draw   = $input['draw'];
        $length = $input['length'];
        $start  = $input['start'];
        $search = $input['search']["value"];
        $filter =  Input::get('search.value');
        /**
            * set count
        **/
        $this->offset = $input['start'];

        $total = Promo::all();
        $result = Promo::take($this->limit);
        if (!empty($filter)) {
            $total =  Promo::where('nama_promo', 'like', '%' . $filter . '%');
            $result = $result->where('nama_promo', 'like', '%' . $filter . '%');
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
    
    public function getRolePromo() {
        $input = Input::all();
        $draw   = $input['draw'];
        /**
            * set count
        **/
        $result  = Promo::getAllDataProd($input, true);
        
        $total = Promo::getAllDataProd($input, false);
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


    public function showFormPromo() {
        $this->parser['label'] = "Promo";
        $html  =  view('admin.dashBoardAdmin.promo.formPromoOrigin', $this->parser)->render();
        $response['html'] = $html;
        return response()->json($response);
    }

    public function showFormPromoEdit() {
        $this->parser['label'] = "Promo";
        $input = Input::all();
        $detail  = Promo::where('id_promo', $input['id'])->get()->toArray();
        if (!empty($detail[0])) {
            $this->parser['dataConfig'] = $detail[0];
        }
        $html  =  view('admin.dashBoardAdmin.promo.formPromoOriginEdit', $this->parser)->render();
        $response['html'] = $html;
        return response()->json($response);
    }

    public function showFormItems() {
        $this->parser['label'] = "Promo";
        $html  =  view('admin.dashBoardAdmin.promo.formPromoOriginItems', $this->parser)->render();
        $response['html'] = $html;
        return response()->json($response);
    }

    public function getPromoList() {
        $input = Input::all();
 
        $items = Promo::where('nama_promo', 'like', '%' . $input['q'] . '%')->get()->toArray();
        
        if(count($items) > 0){
            foreach ($items as $key => $value) {
             $data[] = array('id' => $value['id_promo'], 'text' => $value['nama_promo']);              
            } 
         } else {
            $data[] = array('id' => '', 'text' => 'Outlate Tidak di temukan');
         }
        $response['total_count'] = count($items);
        $response['incomplete_results'] = false;
        $response['items'] = $data;
        return response()->json($response);
    }

    public function getOutlate() {
        $input = Input::all();
        $items = Outlate::where('nama_outlate', 'like', '%' . $input['q'] . '%')->get()->toArray();

        if(count($items) > 0){
            foreach ($items as $key => $value) {
             $data[] = array('id' => $value['id_merchant'], 'text' => $value['nama_outlate']);              
            } 
         } else {
            $data[] = array('id' => '', 'text' => 'Outlate Tidak di temukan');
         }
        $response['total_count'] = count($items);
        $response['incomplete_results'] = false;
        $response['items'] = $data;
        return response()->json($response);
    }

    public function getProduk() {
        $input = Input::all();
        $items = Produk::where('id_merchant', 'like', '%' . $input['idMerchant'] . '%')->get()->toArray();
        $response['total_count'] = count($items);
        $response['incomplete_results'] = false;
        $response['items'] = $items;
        return response()->json($response);
    }
    
    public function doSavePromo(Request $request) {
        $input = Input::all();
        $rules = [
            "nama_promo" => "required",
            "date_start_promo" => "required",
            "date_end_promo" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_promo.required"   => error_message('PromoMessages.nama_promo'),
            "date_start_promo.required"   => error_message('PromoMessages.date_start_promo'),
            "date_end_promo.required"   => error_message('PromoMessages.date_end_promo'),
            "_token.required"   => error_message('PromoMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new Promo;
            if ($request->hasFile('image_promo')) {
                $files = $request->file('image_promo');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $input['image_promo'] =  $picture;
                $produkSave->image_promo = $input['image_promo'];
            }
            $produkSave->nama_promo = $input['nama_promo'];
            $produkSave->date_start_promo = $input['date_start_promo'];
            $produkSave->date_end_promo = $input['date_end_promo'];
            $produkSave->created = date('Y-m-d H:i:s');
            $produkSave->creator = $this->id_user_admin;
            $produkSave->save();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('promolanding.index'), "message" => error_message('PromoMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promolanding.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

    public function doUpdatePromo(Request $request) {
        $input = Input::all();
        $rules = [
            "nama_promo" => "required",
            "date_start_promo" => "required",
            "date_end_promo" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_promo.required"   => error_message('PromoMessages.nama_promo'),
            "date_start_promo.required"   => error_message('PromoMessages.date_start_promo'),
            "date_end_promo.required"   => error_message('PromoMessages.date_end_promo'),
            "_token.required"   => error_message('PromoMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            unset($input['_token']);
            unset($input['id_promo']);
            if ($request->hasFile('image_promo')) {
                $files = $request->file('image_promo');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $input['image_promo'] =  $picture;
            }
            if (empty($input['image_promo'])) {
                unset($input['image_promo']);
            }
            Promo::where('id_promo', Input::get('id_promo'))->update( $input );
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('promolanding.index'), "message" => error_message('PromoMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promolanding.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }


    public function doDeletePromo(Request $request) {
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
            $del = Promo::where('id_promo', $input['id']);
            $del->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('promolanding.index'), "message" => error_message('PromoMessages.successDelete') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promolanding.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }




    public function doSaveRoleItems() {
        $input = Input::all();
       
        $rules = [
            "id_promo" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_promo.required"   => error_message('PromoMessages.id_promo'),
            "_token.required"   => error_message('PromoMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $cekExisting = PromoRole::whereNotIn('id_produk', $input['id_produk'])->where('id_promo', $input['id_promo'])->get()->toArray();
            if (!empty($cekExisting)) {
                foreach($cekExisting as $k => $v) {
                    $del = PromoRole::where('id_produk', $v)->where('id_promo', $input['id_promo']);
                    $del->delete();
                }
            }
            foreach($input['id_produk'] as $key => $val) {
                $cekExisting = PromoRole::where('id_produk', $val)->where('id_promo', $input['id_promo'])->get()->toArray();
                if (empty($cekExisting)) {
                    $produkSave = new PromoRole;
                    $produkSave->id_promo = $input['id_promo'];
                    $produkSave->id_produk = $val;
                    $produkSave->save();
                } 
            } 
            $this->setCallback(['status' => true, 'isRedirect' => false, "redirect" => route('promolanding.index'), "message" => error_message('PromoMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promolanding.index'), "message" => $msg ]);
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

}
