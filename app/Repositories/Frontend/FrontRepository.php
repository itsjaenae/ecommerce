<?php

namespace App\Repositories\Frontend;

use App\{
    Models\Post,
    Models\Page,
    Models\Order,
    Models\Review,
};
use App\Helpers\PriceHelper;
use App\Models\Bcategory;
use App\Models\Category;
use Auth;

class FrontRepository
{

  


    public function displayPage($slug){
        return Page::whereSlug($slug)->firstOrFail();
    }

    public function reviewSubmit($request)
    {

        $user = Auth::user();
        if(count($user->reviews->where('product_id',$request->product_id)) > 0){
            $data['product_id'] = $request->product_id;
            $data['subject'] = $request->subject;
            $data['rating'] = $request->rating;
            $data['review'] = $request->review;
            $data['status'] = 1;
            $user->reviews()->update($data);
            return __('Your Review Updated Successfully.');
        }

        $orders = Order::where('user_id',$user->id)->get();
        $ck = 0;
        foreach($orders as $order)
        {
        $cart = json_decode($order->cart,true);

            foreach($cart as $key => $product)
            {
                if($request->product_id == PriceHelper::GetProductId($key))
                {
                    $ck = 1;
                    break;
                }
            }
        }

        if($ck == 0){
            return [
                'errors' => [
                    0 =>  __("Buy This Product First")
                ]
            ];
        }

        $user->reviews()->create($request->all());
        return __('Your Review Submitted Successfully.');

    }


}
