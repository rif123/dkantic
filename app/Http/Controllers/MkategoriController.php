<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\models\kategoriModel as Kategori;
use App\models\favoriteCategoriModel as FavKategori;
class MkategoriController extends Controller
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
        $this->parser['label'] = "Master kampus";
        return view('admin.dashBoardAdmin.masterKategori', $this->parser);
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getKategori()
     {   
         $input = Input::all();
         $draw   = $input['draw'];
         /**
             * set count
         **/
         $result  = Kategori::getAllData($input, true);
         $total = Kategori::getAllData($input, false);
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
            "nama_kategori" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_kategori.required"   => error_message('MkategoriMessages.nama_kategori'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $produkSave = new Kategori;
            $produkSave->nama_kategori = $input['nama_kategori'];
            $produkSave->created = date('Y-m-d H:i:s');
            $produkSave->creator = $this->id_user_admin;
            $produkSave->save();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKategori.index'), "message" => error_message('MkategoriMessages.success') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKategori.index'), "message" => $msg ]);
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
            "nama_kategori" => "required",
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "nama_kategori.required"   => error_message('MkategoriMessages.nama_kategoris'),
            "id.required"   => error_message('MkategoriMessages.id_kategori'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            Kategori::where('id_kategori', $input['id'])->update( [ 'nama_kategori' => $input['nama_kategori'] ]);
             $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKategori.index'), "message" => error_message('MkategoriMessages.successUpdate') ]);
         } else {
             $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('MkategoriMessages.failedSave');
             $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKategori.index'), "message" => $msg ]);
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
            "id.required"   => error_message('MkategoriMessages.id_kategori'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $del = Kategori::where('id_kategori', $input['id']);
            $del->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKategori.index'), "message" => error_message('MkategoriMessages.successDelete') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('MkategoriMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKategori.index'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }





     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function favoriteKategori()
     {
         $this->parser['label'] = "Master kampus";
         $this->parser['listKategori'] = Kategori::all()->toArray();
         return view('admin.dashBoardAdmin.masterFavoriteKategori', $this->parser);
     }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getFavoriteKategori()
     {
        $input = Input::all();
        $draw   = $input['draw'];
        /**
            * set count
        **/
        $result  = FavKategori::getAllData($input, true);
        $total = FavKategori::getAllData($input, false);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function createFavorite()
     {
        $input = Input::all();
        $rules = [
            "id_kategori" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id_kategori.required"   => error_message('MkategoriMessages.id_kategori'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            if ($this->checkEksistingKategori($input)) {
                $produkSave = new FavKategori;
                $produkSave->id_kategori = $input['id_kategori'];
                $produkSave->created = date('Y-m-d H:i:s');
                $produkSave->creator = $this->id_user_admin;
                $produkSave->save();
                $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKategori.Favoriteindex'), "message" => error_message('MkategoriMessages.success') ]);
            } else {
                $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKategori.Favoriteindex'), "message" => 'Data Telah terdaftar' ]);
            }

        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('settingMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKategori.Favoriteindex'), "message" => $msg ]);
        }
        return response()->json($this->parser);
     }

    private function checkEksistingKategori($input) {
        $getExistingKategori = FavKategori::where('id_kategori', $input['id_kategori'])->get()->toArray();
        if (empty($getExistingKategori)) {
            return true;
        }
        return false;
    }

    public function deleteFavorite() {
        $input = Input::all();
        $rules = [
            "id" => "required",
            "_token" => "required"
        ];
        $messages = [
            "id.required"   => error_message('MkategoriMessages.id_kategori'),
            "_token.required"   => error_message('produkMessages._token')
        ];
        $validator = Validator::make($input, $rules, $messages);
        if (!$validator->fails() && \Session::get("_token") == $input['_token']) {
            $del = FavKategori::where('id_favorite_kategori', $input['id']);
            $del->delete();
            $this->setCallback(['status' => true, 'isRedirect' => true, "redirect" => route('masterKategori.Favoriteindex'), "message" => error_message('MkategoriMessages.successDelete') ]);
        } else {
            $msg = !empty($validator->messages()->first()) ? $validator->messages()->first() :  error_message('MkategoriMessages.failedSave');
            $this->setCallback(['status' => false, 'isRedirect' => false, "redirect" => route('masterKategori.Favoriteindex'), "message" => $msg ]);
        }
        return response()->json($this->parser);
    }
    
    
}
