<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Product')->withDefault();
    }

    public function getWishlistItemId($id)
    {
        return Wishlist::whereProductId($id)->first()->id;
    }

    public static function countWishlist($product_id){
        $countWishlist = Wishlist::where(['user_id' => Auth::user()->id,
        'product_id' => $product_id])->count();
        return $countWishlist;
    }
  



}
