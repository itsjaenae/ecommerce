<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PromoCode;
use App\Models\User;
use Session;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;

class CouponController extends Controller{

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

    public function coupons(){
        Session::put('page','coupons');
    	$coupons = PromoCode::get()->toArray();
    	/*dd($coupons); die;*/

      
    	return view('backend.coupons.coupons')->with(compact('coupons'));
    }
   
 

    public function addEditCoupon(Request $request,$id=null){
        if($id==""){
            // Add Coupon
            $coupon = new PromoCode;
            $selCats = array();
            $selUsers = array();
            $title = "Add Coupon";
            $message = "Coupon added successfully!";
        }else{
            // Update Coupon
            $coupon = PromoCode::find($id);
            $selCats = explode(',',$coupon['categories']);
            $selUsers = explode(',',$coupon['users']);
            $title = "Edit Coupon";
            $message = "Coupon updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();

            // Coupon Validations
            $rules = [
                'categories' => 'required',
                'coupon_option' => 'required',
                'no_of_times' => 'required',
                'type' => 'required',
                'discount' => 'required|numeric',
                'expiry_date' => 'required',
                
            ];
            $customMessages = [
                'categories.required' => 'Select Categories',
                'coupon_option.required' => 'Select Coupon Option',
                'no_of_times.required' => 'Select Coupon Type',
                'type.required' => 'Select discount Type',
                'discount.required' => 'Enter discount',
                'discount.numeric' => 'Enter Valid discount',
                'expiry_date.required' => 'Enter Expiry Date',
            ];
            $this->validate($request,$rules,$customMessages);

            if(isset($data['users'])){
                $users = implode(',', $data['users']);
            }else{
                $users = "";
            }
            if(isset($data['categories'])){
                $categories = implode(',', $data['categories']);
            }
            if($data['coupon_option']=="Automatic"){
                $code_name = Str::random(8);
            }else{
                $code_name = $data['code_name'];
            }
            $coupon->coupon_option = $data['coupon_option'];
            $coupon->code_name = $code_name;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->no_of_times = $data['no_of_times'];
            $coupon->type = $data['type'];
            $coupon->discount = $data['discount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->created_at = Carbon::now();
            $coupon->save();
            session::flash('success_message',$message);
            return redirect('admin/coupons');
        }

        // Sections with Categories and Sub Categories
        $categories = Category::with('subcategory')->get();
        $categories = json_decode(json_encode($categories),true);

        // Users
        $users = User::select('email')->where('status',1)->get()->toArray();

        return view('backend.coupons.add_edit_coupon')
        ->with(compact('title','coupon',
        'categories','users','selCats','selUsers'));
    }


    public function status($id,$status){
        PromoCode::find($id)->update(['status' => $status]);
        return redirect('admin/coupons')->withSuccess(__('Status Updated Successfully.'));
    }



    public function deleteCoupon($id){
        // Delete Coupon
        PromoCode::where('id',$id)->delete();
        $message = 'Coupon has been deleted successfully!';
        session::flash('success_message',$message);
        return redirect()->back();
    }
}
