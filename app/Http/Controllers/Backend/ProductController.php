<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Product,
    Models\Gallery,
    Http\Requests\ProductRequest,
    Http\Controllers\Controller,
    Http\Requests\GalleryRequest,      
    Repositories\Backend\ProductRepository
};
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Currency;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\ProductRepository $repository
     *
     */
    public function __construct(ProductRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
        $this->repository = $repository;
    }


    public function add(){
        
        return view('backend.product.add');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_type = $request->has('item_type') ? ($request->item_type ? $request->item_type : '') : '';
        $is_type = $request->has('is_type') ? ($request->is_type ? $request->is_type : '') : '';
        $category_id = $request->has('category_id') ? ($request->category_id ? $request->category_id : '') : '';
        $orderby = $request->has('orderby') ? ($request->orderby ? $request->orderby : 'desc') : 'desc';

        $datas = Product::
        when($product_type, function ($query, $product_type) {
            return $query->where('item_type', $product_type);
        })
        ->when($is_type, function ($query, $is_type) {
            if($is_type != 'outofstock'){
                return $query->where('is_type', $is_type);
            }else{
                return $query->whereStock(0)->whereItemType('normal');
            }

        })
        ->when($category_id, function ($query, $category_id) {
            return $query->where('category_id', $category_id);
        })
        ->when($orderby, function ($query, $orderby) {
            return $query->orderby('id', $orderby);
        })
        ->get();

        return view('backend.product.index',[
            'datas' => $datas
        ]);
    }

  
 
    public function GetSubCategory($category_id){

      
        $subcat = Subcategory::where('category_id',$category_id)->orderBy('name_en','ASC')->get();
        return json_encode($subcat);
    }


      public function GetSubSubCategory($subcategory_id){

       $subsubcat = ChildCategory::where('subcategory_id',$subcategory_id)->orderBy('name_en','ASC')->get();
       return json_encode($subsubcat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('backend.product.create',[
            'curr' => Currency::where('is_default',1)->first(),
        
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product_id = $this->repository->store($request);


        if($request->is_button ==0){
            return redirect()->route('admin.product.index',$product_id)->withSuccess(__('Product Added Successfully.'));
        }else{
            return redirect(route('admin.product.edit', $product_id))->withSuccess(__('Product Added Successfully.'));
        }

    }


   

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {


        return view('backend.product.edit',[
            'item' => $product,
            'curr' => Currency::where('is_default',1)->first(),
            'social_icons' => json_decode($product->social_icons,true),
            'social_links' => json_decode($product->social_links,true),
            'specification_name' => json_decode($product->specification_name,true),
            'specification_description' => json_decode($product->specification_description,true),
    
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->repository->update($product, $request);

        if($request->is_button ==0){
            return redirect()->route('admin.product.index')->withSuccess(__('Product Updated Successfully.'));
        }else{
            return redirect()->back()->withSuccess(__('Product Updated Successfully.'));
        }
    }

    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status(Product $product,$status)
    {
        $product->update(['status' => $status]);
        return redirect()->back()->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->repository->delete($product);
        return redirect()->back()->withSuccess(__('Product Deleted Successfully.'));
    }






    // ---------------- DIGITAL PRODUCT START ---------------//

    public function digitalProductCreate()
    {
        return view('backend.product.digital.create',[
            'curr' => Currency::where('is_default',1)->first()
        ]);
    }

    public function digitalProductStore(ProductRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('admin.product.index')->withSuccess(__('New Product Added Successfully.'));
    }

    public function digitalProductEdit($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.digital.edit',[
            'item' => $product,
            'curr' => Currency::where('is_default',1)->first(),
            'social_icons' => json_decode($product->social_icons,true),
            'social_links' => json_decode($product->social_links,true),
            'specification_name' => json_decode($product->specification_name,true),
            'specification_description' => json_decode($product->specification_description,true),
        ]);
    }


    // ---------------- LICENSE PRODUCT START ---------------//

    public function licenseProductCreate()
    {
        return view('backend.product.license.create',[
            'curr' => Currency::where('is_default',1)->first()
        ]);
    }

    public function licenseProductStore(ProductRequest $request)
    {
        $this->repository->store($request);
        return redirect()->route('admin.product.index')->withSuccess(__('New Product Added Successfully.'));
    }

    public function licenseProductEdit($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.license.edit',[
            'item' => $product,
            'curr' => Currency::where('is_default',1)->first(),
            'social_icons' => json_decode($product->social_icons,true),
            'social_links' => json_decode($product->social_links,true),
            'specification_name' => json_decode($product->specification_name,true),
            'specification_description' => json_decode($product->specification_description,true),
            'license_name' => json_decode($product->license_name,true),
            'license_key' => json_decode($product->license_key,true),
        ]);
    }


    public function highlight(Product $product)
    {
        return view('backend.product.highlight',[
            'item' => $product
        ]);
    }
    public function highlight_update(Product $product,Request $request)
    {
        $this->repository->highlight($product, $request);
        return redirect()->route('admin.product.index')->withSuccess(__('Product Updated Successfully.'));
    }




    public function stockOut()
    {
        $datas = Product::where('item_type','normal')->where('stock',0)->get();
        return view('backend.product.stockout',compact('datas'));
    }




        /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function galleries(Product $product)
    {
        return view('backend.product.galleries',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function galleriesUpdate(GalleryRequest $request)
    {
        $this->repository->galleriesUpdate($request);
        return redirect()->back()->withSuccess(__('Gallery Information Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function galleryDelete(Gallery $gallery)
    {
        $this->repository->galleryDelete($gallery);
        return redirect()->back()->withSuccess(__('Successfully Deleted From Gallery.'));
    }




}
