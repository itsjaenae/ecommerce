<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name_en',
    'name_frn',
    'name_hin',
    'icon',
    'slug_en',
    'slug_frn',
    'slug_hin',
     'category_id','status'];
    public $timestamps = false;


    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }

    public function childcategory()
    {
        return $this->hasMany('App\Models\ChildCategory')->where('status',1);
    }

    public function items()
    {
        return $this->hasMany('App\Models\Product')->where('status',1);
    }

}
