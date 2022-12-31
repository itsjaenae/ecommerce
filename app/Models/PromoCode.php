<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
    'code_name', 
    'discount','status',
    'no_of_times',
    'type',
      'users','expiry_date',
      'categories','coupon_option'
];
protected $dates = ['expire_date'];
    public $timestamps = false;
}
