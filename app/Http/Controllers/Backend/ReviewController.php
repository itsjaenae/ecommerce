<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Review,
    Http\Controllers\Controller
};
use DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.review.index',[
            'datas' => Review::latest('id')->get(),
           'datap' => DB::table('products')
           ->join('reviews', 'products.id','reviews.product_id')
           ->latest('reviews.id')->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return view('backend.review.show',compact('review'));
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
        $shipping = Review::find($id)->update(['status' => $status]);
        return redirect()->route('admin.review.index')->withSuccess(__('Status Updated Successfully.'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.review.index')->withSuccess(__('Review Deleted Successfully.'));
    }
}
