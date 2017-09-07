<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class userAdminModel extends Model
{
    public $timestamps = false;
    protected $table = 'user_admin';
    protected $fillable = ['id_user_admin', 'username_admin', 'password_admin', 'name_admin', 'created', 'creator', 'edited', 'editor'];
  
}
