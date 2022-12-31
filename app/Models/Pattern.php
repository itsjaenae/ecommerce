<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;
    protected $fillable = ['pattern','status'];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\Product');
    }
}
