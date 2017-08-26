<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class userMerchant extends Model
{
    protected $table = 'users_merchant';
    protected $fillable = ['id_merchant', 'username_merchant','pass_merchant', 'created', 'creator', 'edited', 'editor'];
    
}
