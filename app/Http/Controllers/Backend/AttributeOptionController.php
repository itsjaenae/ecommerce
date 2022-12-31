<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Product,
    Models\Attribute,
    Models\AttributeOption,
    Http\Controllers\Controller,
    Http\Requests\AttributeOptionRequest
};
use App\Models\Currency;
use DB;


class AttributeOptionController extends Controller
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
    public function index(Product $product)
    {

        return view('backend.product.attribute_option.index',[
            'product'  => $product,
            'curr' => Currency::where('is_default',1)->first(),
            'datas' => $product->join('attributes','attributes.product_id','=','products.id')
            ->join('attribute_options','attribute_options.attribute_id','=','attributes.id')
            ->select('attribute_options.id','attribute_options.attribute_id','attribute_options.name',
            'attribute_options.keyword','attribute_options.stock','attribute_options.price',
            \DB::raw('attributes.name as attribute'))
            ->where('products.id','=',$product->id)
            ->latest('id')
            ->get()
 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)   
    {
        return view('backend.product.attribute_option.create',[
            'product'  => $product,
            'curr' => Currency::where('is_default',1)->first(),
            'attributes' => Attribute::whereProductId($product->id)->get()
         
        ]);
    }
    public function size(product $product)
    {
        return view('backend.product.attribute_option.size_create',[
            'product'  => $product,
            'curr' => Currency::where('is_default',1)->first(),
            'attributes' => Attribute::whereProductId($product->id)->get()
         
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeOptionRequest $request, product $product)
    {

        $input = $request->all();
        $curr = Currency::where('is_default',1)->first();
        $input['price'] = $request->price / $curr->value;
        AttributeOption::create($input);

        return redirect()->route('admin.option.index',$product->id)->withSuccess(__('New Attribute Option Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, AttributeOption $option)
    {
        return view('backend.product.attribute_option.edit',[
            'product'  => $product,
            'option' => $option,
            'curr' => Currency::where('is_default',1)->first(),
            'attributes' => Attribute::whereProductId($product->id)->get(),
        
           
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeOptionRequest $request, product $product, AttributeOption $option)
    {

        $input = $request->all();
        $curr = Currency::where('is_default',1)->first();
        $input['price'] = $request->price / $curr->value;
        $option->update($input);

        return redirect()->route('admin.option.index',$product->id)->withSuccess(__('Attribute Option Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, AttributeOption $option)
    {
        $option->delete();
        return redirect()->route('admin.option.index',$product->id)->withSuccess(__('Attribute Option Deleted Successfully.'));
    }
}
