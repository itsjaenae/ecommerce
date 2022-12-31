<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name_en',
    'name_frn',
    'name_hin',
    'slug_en',
    'slug_frn',
    'slug_hin',
        'photo', 
        'status',
        'is_popular'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\Product');
    }

}
