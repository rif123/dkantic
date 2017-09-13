<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\PromoSlideModel as PromoSlide;
use App\models\PromoSlideRoleModel as PromoRoleSlide;
class PromoSliderController extends Controller
{

    private  $id_user_admin = "";
    private  $limit = 2;
    private  $offset = 0;
    private $destinationPath = "";
    public function __construct() {
        $this->id_user_admin = \Session::get('authAdmin.id_user_admin');
        $this->destinationPath = base_path() . '/public/imagePromoSlide';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->parser['label'] = "Promo";
        return view('admin.dashBoardAdmin.promoSlider', $this->parser); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSlide()
    {
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

        $total = PromoSlide::all();
        $result = PromoSlide::take($this->limit);
        if (!empty($filter)) {
            $total =  PromoSlide::where('nama_slide', 'like', '%' . $filter . '%');
            $result = $result->where('nama_slide', 'like', '%' . $filter . '%');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRolePromoSlide()
    {
        $input = Input::all();
        $draw   = $input['draw'];
        /**
            * set count
        **/
        $result  = PromoSlide::getAllDataProd($input, true);
        $total = PromoSlide::getAllDataProd($input, false);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showFormPromoSlide()
    {
        $this->parser['label'] = "Promo";
        $html  =  view('admin.dashBoardAdmin.promoSlide.formPromoSlide', $this->parser)->render();
        $response['html'] = $html;
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doSaveSlide(Request $request)
    {
        $input = Input::all();
        $rules = [
            "nama_slide" => "required",
            "date_start_slide" => "required",
            "date_end_slide" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_slide.required"   => error_message('PromoMessages.nama_promo'),
            "date_start_slide.required"   => error_message('PromoMessages.date_start_promo'),
            "date_end_slide.required"   => error_message('PromoMessages.date_end_promo'),
            "_token.required"   => error_message('PromoMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new PromoSlide;
            if ($request->hasFile('image_slide')) {
                $files = $request->file('image_slide');
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = date('His').$filename;
                $files->move($this->destinationPath, $picture);
                $input['image_slide'] =  $picture;
                $produkSave->image_slide = $input['image_slide'];
            }
            $produkSave->nama_slide = $input['nama_slide'];
            $produkSave->date_start_slide = $input['date_start_slide'];
            $produkSave->date_end_slide = $input['date_end_slide'];
            $produkSave->created = date('Y-m-d H:i:s');
            $produkSave->creator = $this->id_user_admin;
            $produkSave->save();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('promoSLideLanding.index'), "message" => error_message('PromoMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promolanding.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

  
    public function showFormPromoEdit() {
        $this->parser['label'] = "Promo";
        $input = Input::all();
        $detail  = PromoSlide::where('id_slide', $input['id'])->get()->toArray();
        if (!empty($detail[0])) {
            $this->parser['dataConfig'] = $detail[0];
        }
        $html  =  view('admin.dashBoardAdmin.promoSlide.formPromoSlideEdit', $this->parser)->render();
        $response['html'] = $html;
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doUpdatePromoSlide(Request $request)
    {
        $input = Input::all();
        $rules = [
            "nama_slide" => "required",
            "date_start_slide" => "required",
            "date_end_slide" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_slide.required"   => error_message('PromoMessages.nama_promo'),
            "date_start_slide.required"   => error_message('PromoMessages.date_start_promo'),
            "date_end_slide.required"   => error_message('PromoMessages.date_end_promo'),
            "_token.required"   => error_message('PromoMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            unset($input['_token']);
            unset($input['id_slide']);
            unset($input['imageBanner']);
            if ($request->hasFile('image_slide')) {
                if ($request->file('image_slide')->isValid()) {
                    $files = $request->file('image_slide');
                    $filename = $files->getClientOriginalName();
                    $extension = $files->getClientOriginalExtension();
                    $picture = date('His').$filename;
                    $files->move($this->destinationPath, $picture);
                    $input['image_slide'] =  $picture;
                }
            }
            if (empty($input['image_slide'])) {
                unset($input['image_slide']);
            }
            PromoSlide::where('id_slide', Input::get('id_slide'))->update( $input );
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('promoSLideLanding.index'), "message" => error_message('PromoMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promoSLideLanding.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }


    public function doDeletePromoItem() {
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
            $del = PromoSlide::where('id_slide', $input['id']);
            $del->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('promoSLideLanding.index'), "message" => error_message('PromoMessages.successDelete') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promoSLideLanding.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }

    public function showFormItemsSlide() {
        $this->parser['label'] = "Promo";
        $html  =  view('admin.dashBoardAdmin.promo.formPromoSlideItems', $this->parser)->render();
        $response['html'] = $html;
        return response()->json($response);
    }

    public function getPromoListItems() {
        $input = Input::all();
        $items = PromoSlide::where('nama_slide', 'like', '%' . $input['q'] . '%')->get()->toArray();
        if(count($items) > 0){
            foreach ($items as $key => $value) {
            $data[] = array('id' => $value['id_slide'], 'text' => $value['nama_slide']);              
            } 
        } else {
            $data[] = array('id' => '', 'text' => 'Outlate Tidak di temukan');
        }
        $response['total_count'] = count($items);
        $response['incomplete_results'] = false;
        $response['items'] = $data;
        return response()->json($response);
    }

    public function doSaveRoleSlideItems() {
        $input = Input::all();
         $rules = [
             "id_slide" => "required",
             "_token" => "required"
         ];
         $messages = [
             "id_slide.required"   => error_message('PromoMessages.id_promo'),
             "_token.required"   => error_message('PromoMessages._token')
         ];
         $validator = Validator::make($input, $rules, $messages);
         if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
             $cekExisting = PromoRoleSlide::whereNotIn('id_produk', $input['id_produk'])->where('id_slide', $input['id_slide'])->get()->toArray();
             if (!empty($cekExisting)) {
                 foreach($cekExisting as $k => $v) {
                     $del = PromoRoleSlide::where('id_produk', $v)->where('id_slide', $input['id_slide']);
                     $del->delete();
                 }
             }
             foreach($input['id_produk'] as $key => $val) {
                 $cekExisting = PromoRoleSlide::where('id_produk', $val)->where('id_slide', $input['id_slide'])->get()->toArray();
                 if (empty($cekExisting)) {
                     $produkSave = new PromoRoleSlide;
                     $produkSave->id_slide = $input['id_slide'];
                     $produkSave->id_produk = $val;
                     $produkSave->save();
                 } 
             } 
             $this->setCallback(['status' => true, 'isRedirect' => false, "redirect" => route('promoSLideLanding.index'), "message" => error_message('PromoMessages.success') ]);
         } else {
             $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
             $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('promoSLideLanding.index'), "message" => $msg ]);
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
