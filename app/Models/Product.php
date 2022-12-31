<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Product extends Model
{

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'name_en',
        'name_frn',
        'name_hin',
        'slug_frn',
        'slug_hin','slug_en',
        'sku',
        'tags','video','sort_details',
        'specification_name',
        'specification_description',
        'is_specification','details','photo',
        'thumbnail','discount_price',
        'previous_price','stock','meta_keywords',
        'meta_description','status','is_type',
        'tax_id','date','item_type','file',
        'link','file_type','license_name',
        'license_key','affiliate_link',
        'phot_deals',
        'pfeatured',
        'pspecial_offer',
        'pspecial_deals',
        'fabric_id', 'pattern_id','sleeve_id',
        'fit_id',	'occasion_id','neck_id',
    ];




    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory')->withDefault();
    }

    public function childcategory()
    {
        return $this->belongsTo('App\Models\ChildCategory')->withDefault();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand')->withDefault();
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\CampaignItem');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\Tax')->withDefault();
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }


    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public static function taxCalculate($product)
    {
        if($product->tax){
            $price = $product->discount_price;
            $percentage = $product->tax->value;
            $tax = ($price * $percentage) / 100;
            return $tax;
        }else{
            return 0;
        }
        
    }

    


    public function getWishlistItemId()
    {
        return Wishlist::whereProductId($this->id)->first()->id;
    }


    public function user()
    {
    	return $this->belongsTo('App\Models\User','vendor_id')->withDefault();
    }


    public function is_stock()
    {
      
   
       $product = $this;
        // license product stock check------------
        if($product->item_type == 'license' ) {
            if($product->license_key){
                $lisense_key = json_decode($product->license_key,true);
                if(count($lisense_key) > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        // digital product stock check-------------

        if($product->item_type == 'digital'){
            return true;
        }
        if($product->item_type == 'affiliate'){
            return true;
        }

        // physical product stock check

        if($product->item_type == 'normal'){
            if($product->stock){
                if($product->stock != 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
          
        }
     
    }

}
