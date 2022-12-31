<?php

namespace App\Http\Controllers\Backend;

use App\{
    Models\Product,
    Models\Attribute,
    Http\Controllers\Controller,
    Http\Requests\AttributeRequest
};
use DB;

class AttributeController extends Controller
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
    public function index(product $product)
    {
        return view('backend.product.attribute.index',[
            'product'  => $product,
            'datas' => $product->attributes()->orderBy('id','desc')->get()
    //         'pdatas' => Attribute::with('colors','sizes')
    //     ->whereIn('product_id',$product)->get(),
            
    //    'datas' =>  DB::table('attributes')
    //  ->join('colors','colors.id', 'attributes.color')
    // ->join('sizes','sizes.id','attributes.size')
    //  ->whereIn('product_id',$product)
    //  ->orderBy('attributes.id','desc')
    //  ->get(),
      
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(product $product)
    {
        return view('backend.product.attribute.create',compact('product'));
    }
    
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request, product $product)
    {
        Attribute::create($request->all());
        return redirect()->route('admin.attribute.index',$product->id)->withSuccess(__('New Attribute Added Successfully.'));
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product, Attribute $attribute)
    { $data= Attribute::where('id',$attribute)->first();
        return view('backend.product.attribute.edit',compact(
            'product','attribute','data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, product $product, Attribute $attribute)
    {
        $attribute->update($request->all());
        return redirect()->route('admin.attribute.index',$product->id)->withSuccess(__('Attribute Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idproduct $product, Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $attribute->options()->delete();
   //   $attribute->delete();
      Attribute::where('id',$id)->delete();
        return redirect()->back()->withSuccess(__('Attribute Deleted Successfully.'));
    }
}
