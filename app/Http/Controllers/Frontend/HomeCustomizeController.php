<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCustomize;
use App\Models\Product;

class HomeCustomizeController extends Controller{

    // category get
    public function CategoryGet($category_slug,$type,$check)
    {
        $category = Category::whereSlugEn($category_slug)->first();

        $homecustomize = HomeCustomize::first();

        $datas = json_decode($homecustomize[$type],true);

        $index = '';
        foreach($datas as $key => $data){
           if($data == $category->id){
               $index = $key;
           }
        }

        $category = $category->id;
        $subcategory = $datas['sub'.$index];
        $childcategory = $datas['child'.$index];
        if($type == 'feature_category'){
            $items = Product::with('category')
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($subcategory, function ($query, $subcategory) {
                return $query->where('subcategory_id', $subcategory);
            })
            ->when($childcategory, function ($query, $childcategory) {
                return $query->where('childcategory_id', $childcategory);
            })
            ->whereStatus(1)->take(10)->orderby('id','desc')->get();
        }else{
            $items = Product::with('category')
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($subcategory, function ($query, $subcategory) {
                return $query->where('subcategory_id', $subcategory);
            })
            ->when($childcategory, function ($query, $childcategory) {
                return $query->where('childcategory_id', $childcategory);
            })
            ->whereStatus(1)->take(10)->get();
        }


    if($check != 'normal'){
        return view('frontend.includes.slider_product',compact('items'));
    }else{
        return view('frontend.includes.normal_product',compact('items'));
    }

    }


    public function productGet($type)
    {
        $items = Product::where('is_type',$type)->whereStatus(1)->orderby('id','desc')->take(10)->get();
        return view('frontend.includes.type_product',compact('items'));
    }
}