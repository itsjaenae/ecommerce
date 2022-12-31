<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CampaignItem;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }


    public function index()
    {
    //    $items= DB::table('campaign_items')
    //    ->join('products','products.id','campaign_items.product_id')
    //    ->orderby('campaign_items.id','desc')->get();
    //    $campaign= CampaignItem::orderby('id','desc')->get();
    $items = CampaignItem::orderby('id','desc')->get();
    $datas = Product::whereStatus(1)->select('name_en','id')->orderBy('id','desc')->get();
        return view('backend.product.campaign',[
            'items' => $items,
           'datas' => $datas,
        ]);
    } 


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);
        if(CampaignItem::whereProductId($request->product_id)->exists()){
            return redirect()->route('admin.campaign.index')->withError(__('Already Added This Product.'));

        }
        $data = new CampaignItem();
        $data->create($request->all());
        return redirect()->route('admin.campaign.index')->withSuccess(__('New Product Added Successfully.'));

    }


    public function destroy($id)
    {
        $data = CampaignItem::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.campaign.index')->withSuccess(__('Product Delete Successfully Successfully.'));
    }



    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id,$status,$type)
    {

        if($type == 'is_feature' && $status == 1){

            if(CampaignItem::whereIsFeature(1)->count() == 10){
                return redirect()->route('admin.campaign.index')->withError(__('10 products are already added to feature'));
            }
        }
        $item = CampaignItem::findOrFail($id);
        $item->update([$type => $status]);
        return redirect()->route('admin.campaign.index')->withSuccess(__('Status Updated Successfully.'));
    }


}
