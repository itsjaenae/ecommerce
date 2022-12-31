<?php

namespace App\Http\Middleware;


use App\Models\Language;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Auth;

class Admin
{ 
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   
    public function handle(Request $request, Closure $next)
    {
        $language = Language::whereType('Dashboard')->where('is_default',1)->first();
        App::setlocale($language->name);

        return $next($request);

        // if(!Auth::guard('admin')->check()){
        //     return redirect()->route('back.login')->with('error','Plz Login First');
        // }
        // return $next($request);
    }
}