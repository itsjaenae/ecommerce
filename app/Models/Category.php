<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name_en',
    'name_frn',
    'name_hin',
    'icon',
    'slug_en',
    'slug_frn',
    'slug_hin',
    'photo',
    'status',
    'is_feature',
    'meta_keywords',
    'meta_descriptions',
    'serial'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function subcategory()
    {
        return $this->hasMany('App\Models\Subcategory');
    }

    public function childcategory()
    {
        return $this->hasMany('App\Models\ChildCategory');
    }



}
