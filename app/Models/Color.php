<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['color','keyword','status'];

    public $timestamps = false;

  
    public function options()
    {
        return $this->hasMany('App\Models\ProductAttribute','color_id','id')->withDefault();
    }

}
