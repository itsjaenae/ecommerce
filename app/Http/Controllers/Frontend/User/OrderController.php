<?php

namespace App\Http\Controllers\Frontend\User;

use App\{
    Models\Order,
    Models\TrackOrder,
    Http\Controllers\Controller
};

use Auth;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('localize');

    }

    public function index()
    {
        $orders = Order::whereUserId(Auth::user()->id)->latest('id')->get();
        return view('frontend.user.order.index',compact('orders'));
    }

  
    public function details($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('frontend.user.order.invoice',compact('user','order','cart'));
    }

    public function printOrder($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        return view('frontend.user.order.print',compact('user','order','cart'));
    }


    public function delete($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);
        $order->delete();
        Session::flash('success',__('Successfully Removed From Wishlist.'));
        return redirect()->back();
    }
}
