<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['size','keyword','status'];

    public $timestamps = false;

   
    public function option()
    {
        return $this->hasMany('App\Models\ProductAttribute','size_id','id');
    }

    public function options()
    {
        return $this->hasMany('App\Models\ProductAttribute','size_id','id');
    }
}
