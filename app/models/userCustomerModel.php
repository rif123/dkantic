<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class userCustomerModel extends Model
{
    public $timestamps = false;
    protected $table = 'user_customer';
    protected $fillable = ['id_customer', 'nama_customer', 'pass_customer',  'alamat_customer',  'email_customer', 'hp_customer',  'created', 'creator', 'edited', 'editor'];
}
