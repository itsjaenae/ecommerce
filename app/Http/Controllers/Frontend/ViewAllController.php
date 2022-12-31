<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\{
    Models\Product,
    Models\Setting,
    Models\Subscriber,
    Helpers\EmailHelper,
    Http\Requests\ReviewRequest,
    Http\Requests\SubscribeRequest,
    Repositories\Frontend\FrontRepository
};
use App\Helpers\SmsHelper;
use App\Models\Brand;
use App\Models\CampaignItem;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Fcategory;
use App\Models\HomeCustomize;
use App\Models\Order;
use App\Models\Language;
use App\Models\Post;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\TrackOrder;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
  
use function GuzzleHttp\json_decode;
use DB;
use Image;
use Carbon\Carbon;
use Auth;

class ViewAllController extends Controller{

    public function __construct(FrontRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('localize');

    }


public function recommended(){
    $hot_deals = Product::where('phot_deals',1)->orderBy('id','DESC')->get();
    return view('frontend.view_all.hot_deals',compact('hot_deals'));
}


public function SpecialDeals(){
    $special_deals = Product::where('pspecial_deals',1)->orderBy('id','DESC')->get();
    return view('frontend.view_all.special_deals',compact('special_deals'));
}

public function SpecialOffer(){
    $special_offer = Product::where('pspecial_offer',1)->orderBy('id','DESC')->get();
    return view('frontend.view_all.special_offer',compact('special_offer'));
}


public function featured(){
    $featured = Product::where('pfeatured',1)->orderBy('id','DESC')->get();
    return view('frontend.view_all.featured',compact('featured'));
}


}





