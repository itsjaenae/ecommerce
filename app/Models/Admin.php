<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'photo',
        'email_token',
        'password'
    ];
  
    protected $hidden = [
        'password',
    ];



    public function role()
    {
    	return $this->belongsTo('App\Models\Role')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function IsSuper(){
        if ($this->id == 1) {
           return true;
        }
        return false;
    }

    public function sectionCheck($value){
        $sections = json_decode($this->role->section,true);
        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
    }

}
