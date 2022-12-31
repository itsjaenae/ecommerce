<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable = ['name_en',
    'name_hin',
    'name_frn',
    'slug_en',
    'slug_hin',
    'slug_frn',
    'status',
    'category_id',
    'subcategory_id'
];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory')->withDefault();
    }

    public function items()
    {
        return $this->hasMany('App\Models\Product','childcategory_id')->where('status',1);
    }
}
