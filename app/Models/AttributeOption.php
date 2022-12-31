<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;
    protected $fillable = ['attribute_id', 'name','size', 'keyword', 'price','stock'];

  public function attribute() {
    return $this->belongsTo('App\Models\Attribute')->withDefault();
  }


 
  public $timestamps = false;
}
