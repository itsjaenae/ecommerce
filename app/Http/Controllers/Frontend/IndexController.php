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

class IndexController extends Controller{

    public function __construct(FrontRepository $repository)
    {
        $this->repository = $repository;
        $setting = Setting::first();
        if($setting->recaptcha == 1){
            Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
            Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
        }

        $this->middleware('localize');

    }

// -------------------------------- HOME ----------------------------------------

	public function index()
	{
        $setting = Setting::first();


              $home_customize = HomeCustomize::first();

            if($setting->theme == 'theme1'){
                $sliders = Slider::where('home_page','theme1')->get();
            }elseif($setting->theme == 'theme2'){
                $sliders = Slider::where('home_page','theme2')->get();
            }elseif($setting->theme == 'theme3'){
                $sliders = Slider::where('home_page','theme3')->get();
            }else{
                $sliders = Slider::where('home_page','theme4')->get();
            }

              // popular category
            $home_customize = HomeCustomize::first();
            $popular_category_ids = json_decode($home_customize->popular_category,true);
            $popular_category_title = $popular_category_ids['popular_title'];

            $popular_category = [];
                for($i=1;$i<=4;$i++){
                    if(!in_array($popular_category_ids['category_id'.$i],$popular_category)){
                        if($popular_category_ids['category_id'.$i]){
                            $popular_category[] = $popular_category_ids['category_id'.$i];
                        }
                    }
                }
                $popular_categories = [];
                foreach($popular_category as $key => $cat){
                    $popular_categories[] = Category::findOrFail($cat);
                }

            $popular_category_items = [];

            if(count($popular_categories) > 0){
                $index = '';
                foreach($popular_categories as $key => $data){
                   if($data->id == $popular_category_ids['category_id1']){
                       $index = $key;
                   }
                }
            $pupular_cateogry_home4 = null;
            if($setting->theme == 'theme4'){
                $pupular_cateogries_home4 = json_decode($home_customize->home_4_popular_category,true);
                $pupular_cateogry_home4 = [];
                foreach($pupular_cateogries_home4 as $home4category){
                    $pupular_cateogry_home4[] = Category::with('items')->findOrFail($home4category);
                }
            }

         //   dd($pupular_cateogry_home4);
            $category = $popular_categories[$index]->id;
            $subcategory = $popular_category_ids['subcategory_id1'];
            $childcategory = $popular_category_ids['childcategory_id1'];

            $popular_category_items = Product::when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($subcategory, function ($query, $subcategory) {
                return $query->where('subcategory_id', $subcategory);
            })
            ->when($childcategory, function ($query, $childcategory) {
                return $query->where('childcategory_id', $childcategory);
            })
            ->whereStatus(1)->get();
            }



          //  feature category
            $feature_category_ids = json_decode($home_customize->feature_category,true);
            $feature_category_title = $feature_category_ids['feature_title'];
            $feature_category = [];
                for($i=1;$i<=4;$i++){
                    if(!in_array($feature_category_ids['category_id'.$i],$feature_category)){
                        if($feature_category_ids['category_id'.$i]){
                            $feature_category[] = $feature_category_ids['category_id'.$i];
                        }
                    }
                }

            $feature_categories = [];
            foreach($feature_category as $key => $cat){
                $feature_categories[] = Category::findOrFail($cat);
            }
            $feature_category_items = [];
            if(count($feature_categories)){
                $index = '';
                foreach($feature_categories as $key => $data){
                   if($data->id == $feature_category_ids['category_id1']){
                       $index = $key;
                   }
                }

                $category = $feature_categories[$index]->id;
                $subcategory = $feature_category_ids['subcategory_id1'];
                $childcategory = $feature_category_ids['childcategory_id1'];

                $feature_category_items = Product::when($category, function ($query, $category) {
                    return $query->where('category_id', $category);
                })
                ->when($subcategory, function ($query, $subcategory) {
                    return $query->where('subcategory_id', $subcategory);
                })
                ->when($childcategory, function ($query, $childcategory) {
                    return $query->where('childcategory_id', $childcategory);
                })
                ->whereStatus(1)->take(10)->orderby('id','desc')->get();
            }

        
            // {"title1":"Watchtt","subtitle1":"50% OFF","url1":"#","title2":"Man","subtitle2":"40% OFF","url2":"#","img1":"1637766462banner-h2-4-1.jpeg","img2":"1637766420banner-h2-4-1.jpeg"}

            return view('frontend.index.home',[
              
                'banner_first'   => json_decode($home_customize->banner_first,true),
                'sliders'  => $sliders,
                 'campaign_items' => CampaignItem::with(['item'])->whereStatus(1)->whereIsFeature(1)->orderby('id','desc')->get(),
                 'services' => Service::orderby('id','desc')->get(),
                 'brands'   => Brand::whereStatus(1)->get(),
                 'brands'   => Brand::whereStatus(1)->whereIsPopular(1)->get(),
                 'products' => Product::with('category')->whereStatus(1),
                 'hot_deals' => Product::where('phot_deals',1)->orderBy('id','DESC')->get(),
                 'special_deals' => Product::where('pspecial_deals',1)->orderBy('id','DESC')->get(),
                 'special_offer' => Product::where('pspecial_offer',1)->orderBy('id','DESC')->get(),
                 'featured_category' => Product::where('pfeatured',1)->orderBy('id','DESC')->get(),

                 // POPULAR CATEGORIES
                 'popular_category_items' => $popular_category_items,
                 'popular_categories' => $popular_categories,
                 'popular_category_title' => $popular_category_title,
                 'pupular_cateogry_home4' => isset($pupular_cateogry_home4) ? $pupular_cateogry_home4 : [],
              
                 'banner_third'   => json_decode($home_customize->banner_third,true),
                 'banner_second'  => json_decode($home_customize->banner_second,true),
         
                // feature category
               'feature_category_items' => $feature_category_items,
               'feature_categories' => $feature_categories,
               'feature_category_title' => $feature_category_title,

            ]);
	}



// -------------------------------- CAMPAIGN ----------------------------------------

public function campaignProduct()
{
    if(Setting::first()->is_campaign == 0){
        return back();
    }
    $campaign_items =  CampaignItem::whereStatus(1)->orderby('id','desc')->get();
    return view('frontend.campaign',['campaign_items' => $campaign_items]);
}

// -------------------------------- CAMPAIGN ----------------------------------------

   

public function products($slug_en){  
// $products = Product::with('category')->whereStatus(1)->whereSlugEn($slug_en)->get(); 
// foreach($products as $arr){
//     $result =
//         DB::table('product_attributes')
//         ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
//         ->leftJoin('colors','colors.id','=','product_attributes.color_id')
//         ->where(['product_attributes.product_id'=>$arr->id])
//         ->get();
// }

    $product = Product::with('category')->whereStatus(1)->whereSlugEn($slug_en)->firstOrFail();
    $video = explode('=',$product->video);

    return view('frontend.catalog.product_details',[
        'item'          => $product,
        'reviews'       => $product->reviews()->where('status',1)->paginate(3),
        'galleries'     => $product->galleries,
        'video'         => $product->video ? end($video) : '',
        'sec_name'      => isset($product->specification_name) ? json_decode($product->specification_name,true) : [],
        'sec_details'   => isset($product->specification_description) ? json_decode($product->specification_description,true) : [],
        'related_items' => $product->category->items()->whereStatus(1)->where('id','!=',$product->id)->take(8)->get(),
         'attributes'    => $product->attributes,
    ]);
}    
   

// -------------------------------- FAQ ----------------------------------------
public function faq(){
    if(Setting::first()->is_faq == 0){
        return back();
    }
    $fcategories =  Fcategory::whereStatus(1)->withCount('faqs')->latest('id')->get();
    return view('frontend.faq.index',['fcategories' => $fcategories]);
}

public function show($slug)
{
    if(Setting::first()->is_faq == 0){
        return back();
    }
    $category =  Fcategory::whereSlug($slug)->first();
    return view('frontend.faq.show',['category' => $category]);
}

// -------------------------------- FAQ ----------------------------------------

public function page($slug)
{
    return view('frontend.page',[
        'page' => $this->repository->displayPage($slug)
    ]);
}

// -------------------------------- CURRENCY ----------------------------------------
public function currency($id){
    Session::put('currency',$id);
    return back();
}

// -------------------------------- LANGUAGE ----------------------------------------
public function language($id){
    Session::put('language',$id);
    return back();
}



// -------------------------------- CONTACT ----------------------------------------

public function contact()
{
    if(Setting::first()->is_contact == 0){
        return back();
    }
    return view('frontend.contact');
}

public function contactEmail(Request $request)
{
    $request->validate([
        'first_name' => 'required|max:50',
        'last_name' => 'required|max:50',
        'email' => 'required|email|max:50',
        'phone' => 'required|max:50',
        'message' => 'required|max:250',
    ]);
    $input = $request->all();

    $setting = Setting::first();
    $name  = $input['first_name'].' '.$input['last_name'];
    $subject = "Email From ".$name;
    $to = $setting->contact_email;
    $phone = $request->phone;
    $from = $request->email;
    $msg = "Name: ".$name."<br/>Email: ".$from."<br/>Phone: ".$phone."<br/>Message: ".$request->message;

    $emailData = [
        'to' => $to,
        'subject' => $subject,
        'body' => $msg,
    ];

    $email = new EmailHelper();
    $email->sendCustomMail($emailData);
    Session::flash('success',__('Thank you for contacting with us, we will get back to you shortly.'));
    return redirect()->back();
}


    public function slider_o_update(Request $request){
        $setting = Setting::find(1);
        $setting->overlay = $request->slider_overlay;
        $setting->save();
        return redirect()->back();
    }


    public function brands()
    {
        if(Setting::first()->is_brands == 0){
            return back();
        }
        return view('front.brand',[
            'brands' => Brand::whereStatus(1)->get()
        ]);
    }


	

    public function blogDetails($id)
    {
        $products = $this->repository->displayPost($id);

        return view('front.blog.show',[
            'post' => $products['post'],
            'categories' => $products['categories'],
            'tags' => $products['tags'],
            'posts' => $products['posts'],

        ]);
    }


// -------------------------------- REVIEW ----------------------------------------


public function review_submit(){
    return view('frontend.overlay.index');
}

    public function reviews()
    {
        return view('frontend.reviews');
    }

    public function topReviews()
    {
        return view('frontend.top-reviews');
    }

    public function reviewSubmit(ReviewRequest $request)
    {
        return response()->json($this->repository->reviewSubmit($request));
    }



// -------------------------------- SUBSCRIBE ----------------------------------------

    public function subscribeSubmit(SubscribeRequest $request)
    {
        Subscriber::create($request->all());
        return response()->json(__('You Have Subscribed Successfully.'));
    }


    // ---------------------------- TRACK ORDER ----------------------------------------//
    public function trackOrder()
    {
        return view('frontend.track_order');
    }

    public function track(Request $request)
    {
        $order = Order::where('transaction_number',$request->order_number)->first();

        if($order){
            return view('frontend.user.order.track',[
                'numbers' => 3,
                'track_orders' => TrackOrder::whereOrderId($order->id)->get()->toArray()
            ]);
        }else{
            return view('frontend.user.order.track',[
                'numbers' => 3,
                'error' => 1,
            ]);
        }
    }


    public function maintainance()
    {
        $setting = Setting::first();
        if($setting->is_maintainance == 0){
            return redirect(url('/'));
        }
        return view('frontend.maintainance');
    }



    public function finalize()
    {
        return redirect(url('/'));
    }



   
}





