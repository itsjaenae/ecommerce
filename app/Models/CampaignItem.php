<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignItem extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id', 'status','is_feature'];

    //product
    // public function item()
    // {
    //     return $this->belongsTo('App\Models\Product');
    // }

    public function item()
    {
        return $this->belongsTo('App\Models\Product','product_id')->orderby('id','desc');;
    }
}

