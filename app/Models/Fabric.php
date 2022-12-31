<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;
    protected $fillable = ['fabric','status'];

    public $timestamps = false;


    public function items()
    {
        return $this->hasMany('App\Models\Product');
    }

}
