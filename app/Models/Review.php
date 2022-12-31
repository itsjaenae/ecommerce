<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id','product_id','review','rating','status','subject'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function item()
    {
    	return $this->belongsTo('App\Models\Product')->withDefault();
    }

    public static function ratings($product_id){
        $stars = Review::whereStatus(1)->whereProductId($product_id)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '') * 20;
        return $ratings;
    }


}
