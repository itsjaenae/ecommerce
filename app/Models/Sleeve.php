<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sleeve extends Model
{
    use HasFactory;
    protected $fillable = ['sleeve','status'];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\Product');
    }
}
