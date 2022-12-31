<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\PromoCode,
    Models\Category,
    Models\User,
    Http\Requests\CouponRequest,
    Http\Controllers\Controller
};
use App\Models\Currency;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponController extends Controller
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
    public function index()
    {
        return view('backend.coupon.index',[
            'datas' => PromoCode::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('subcategory')->get();
        $categories = json_decode(json_encode($categories),true);

        // Users
        $users = User::select('email')->where('status',1)->get()->toArray();


        return view('backend.coupon.create',
        compact( 'categories','users',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $curr = Currency::where('is_default',1)->first();
        $input = $request->all();

        if($input['type'] == 'amount'){
            $input['discount'] = $input['discount'] / $curr->value;
        }

        if(isset($input['users'])){
            $users = implode(',', $input['users']);
        }else{
            $users = "";
        }

        if(isset($input['categories'])){
            $categories = implode(',', $input['categories']);
        }

      
        $coupon = new PromoCode;
        $coupon->title = $input['title'];
        $coupon->code_name = $input['code_name'];
        $coupon->categories = $categories;
        $coupon->users = $users;
        $coupon->type = $input['type'];
        $coupon->no_of_times = $input['no_of_times'];
        $coupon->discount = $input['discount'];
        $coupon->expiry_date = $input['expiry_date'];
        $coupon->status = 1;
        $coupon->created_at = Carbon::now();
        $coupon->save();
       // PromoCode::create($input);
        return redirect()->route('admin.coupon.index')->withSuccess(__('New Promo Code Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoCode $code)
    {
        $curr = Currency::where('is_default',1)->first();
        $categories = Category::with('subcategory')->get();
        $categories = json_decode(json_encode($categories),true);

        // Users
        $users = User::select('email')->where('status',1)->get()->toArray();

        return view('backend.coupon.edit',compact('code','curr', 'categories','users',));
    }


    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $pos
     * @return \Illuminate\Http\Response
     */
    public function status($id,$status)
    {
        PromoCode::find($id)->update(['status' => $status]);
        return redirect()->route('admin.coupon.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, PromoCode $code)
    {
        $curr = Currency::where('is_default',1)->first();
        $input = $request->all();
        if($input['type'] == 'amount'){
            $input['discount'] = $input['discount'] / $curr->value;
        }

        $code->update($input);
        return redirect()->route('admin.coupon.index')->withSuccess(__('Promo Code Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $code)
    {
        $code->delete();
        return redirect()->route('admin.coupon.index')->withSuccess(__('Promo Code Deleted Successfully.'));
    }
}
