<?php

namespace App\Http\Controllers\Auth\Backend;

use App\Http\Controllers\Controller;
use  App\Http\Requests\Auth\BackRequest;
use Illuminate\Http\Request;
use Auth;

//use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class AdminController extends Controller
{
    
    public function Index(){
        return view('backend.auth.login');   
    } // end mehtod 


    public function Dashboard(){
        //$id = Auth::user()->id;
       // $user = Admin::find($id);
        return view('backend.dashboard.index'//,compact('user')
    );
    }// end mehtod 

   /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\BackRequest  $request
     * @return \Illuminate\Http\
     */
    public function login(BackRequest $request)
    {
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withErrors(__('Email Or Password Doesn\'t Match !'))->withInput($request->except('password'));
    }

    // public function Login(Request $request){
    //     // dd($request->all());

    //     $check = $request->all();
    //     if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']  ])){
    //         return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully');
    //     }else{
    //         return back()->with('error','Invaild Email Or Password');
    //     }

    // } // end mehtod 


    // public function AdminLogout(){

    //     Auth::guard('admin')->logout();
    //     return redirect()->route('back.login')->with('error','Admin Logout Successfully');
    // } // end mehtod 


    // public function AdminRegister(){

    //     return view('backend.auth.register');

    // } // end mehtod 



    // public function AdminRegisterCreate(Request $request){

    //     // dd($request->all());

    //     Admin::insert([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'created_at' => Carbon::now(),

    //     ]);

    //      return redirect()->route('back.login')->with('error','Admin Created Successfully');

    // } // end mehtod 

}
 