<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class configModel extends Model
{
    public $timestamps = false;
    protected $table = 'config';
    protected $fillable = ['id_config', 'telp_config', 'logofile_config', 
         'fb_config',  'logo_fb_config', 'twit_config', 
         'logo_twit_config', 'gp_config', 'logo_gp_config', 'li_config', 
         'logo_li_config', 'skype_config', 'logo_skype_config', 'footer_tittle_config',
         'cc_config', 'favicon_config'];
}
