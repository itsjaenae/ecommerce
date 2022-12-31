<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','color_id','size_id',  'price','stock'];

 // public function colors() {
  //  return $this->belongsTo('App\Models\Color')->withDefault();
 // }

  public function sizes() {
    return $this->belongsTo('App\Models\Size')->withDefault();
  }
  public function attribute() {
    return $this->belongsTo('App\Models\Color')->withDefault();
  }

  public function colors()
  {
      return $this->hasMany('App\Models\ProductAttribute','color_id','id');
  }

  public function options()   
  {
      return $this->hasMany('App\Models\Color','color','id');
  }

  public $timestamps = false;
}
