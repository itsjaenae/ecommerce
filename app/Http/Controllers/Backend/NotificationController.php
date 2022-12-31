<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Notification,
    Http\Controllers\Controller
};
use DB;

class NotificationController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications(){
        return view('backend.notification.index');
    }


    public function view_notification()
    {
        return view('backend.notification.notification',[
            'data'=>Notification::orderby('id','desc')
        ]);

    }

    public function delete($id)
    {
        Notification::findOrFail($id)->delete();
        return back()->withSuccess(__('Notification Delete Successfully.'));
    }


    /**
     * Clear a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear_notf(){
        Notification::truncate();
    }

}
