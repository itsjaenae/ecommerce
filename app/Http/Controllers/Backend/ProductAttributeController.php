<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\{
    Models\Product,
    Models\Color,
    Models\Size,
    Models\ProductAttribute,
    Http\Controllers\Controller,
    Http\Requests\ProductAttributeRequest
};
use App\Models\Currency;
use DB;
use Carbon\Carbon;
use Session;

class ProductAttributeController extends Controller{
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

   
    public function addAttributes(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            foreach ($data['color_id'] as $key => $value) {
                if(!empty($value)){
                    
                      // Color already exists check
                      $attrCountColor = ProductAttribute::where(['product_id'=>$id,
                      'color_id'=>$data['color_id'][$key]])->count();
                    if($attrCountColor>0){
                   
                        return redirect()->back()->withSuccess(__('Color already exists. Please add another Color!'));
                    }

                    $attrCountSize = ProductAttribute::where(['product_id'=>$id,
                    'size_id'=>$data['size_id'][$key]])->count();
                    if($attrCountSize>0){
                       
                        return redirect()->back()->withSuccess(__('Size already exists. Please add another Size!'));
                    }

                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->size_id = $data['size_id'][$key];
                    $attribute->color_id = $data['color_id'][$key];
                    $attribute->price = !empty($data['price'][$key]) ? $data['price'] : 0;
                    $attribute->stock = $data['stock'][$key];
                  //  $attribute->status = 1;
                    $attribute->save();   
                }
            }  

            return redirect()->back()->withSuccess(__('Product Attributes has been added successfully!'));
        }

        $data = Product::with(['attributes'])->find($id);
        $data = json_decode(json_encode($data),true);

        $pdata = ProductAttribute::with(['colors','sizes'])
        ->where('product_id',$id)->get();
        $pdata = json_decode(json_encode($pdata),true);

        return view('backend.product.product_attribute.create')->with(compact('data','pdata'));
    }



    public function editAttributes(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();//->except(['_token']);
           
            $request->validate([
             'color_id' => 'nullable',
             'size_id' => 'nullable',
             'stock' => 'nullable',    
            // 'price' => 'nullable|min:value:0',
           ]);
       
           $color = $request['color_id'];
           $size = $request['size_id'];
             $stock = $request['stock'];
             $price = $request['price'];//!empty($data['price'][$key]) ? $data['price'] : 0
   foreach ($price as $key => $attr) {
     $data= ProductAttribute::where('id',$id)->update([
       'color_id'=> !empty($color[$key]) ? $color[$key] : '',
       'size_id' => !empty($size[$key]) ? $size[$key] : '',
             'stock' => !empty($stock[$key]) ? $stock[$key] : '',
             'price'=> !empty($price[$key]) ? $price[$key] : 0,
    ]);
  }
            $message = 'Product attributes has been updated successfully!';
            session::flash('success_message',$message);
            return redirect()->back();
        }

        $pdata = ProductAttribute::with(['colors','sizes'])
        ->where('product_id',$id)->get();
        $pdata = json_decode(json_encode($pdata),true);

        $datas =  DB::table('product_attributes')
        ->join('colors','colors.id', 'product_attributes.color_id')
        ->join('sizes','sizes.id','product_attributes.size_id')
        ->where('product_id',$id)
        ->orderBy('product_attributes.id','desc')->get();
       $datas = json_decode(json_encode($datas),true);

        return view('backend.product.product_attribute.edit')->with(compact('pdata','datas'));
    }




       
    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }



    public function deleteAttribute($id){
        // Delete Attribute
        ProductAttribute::where('id',$id)->delete();
        $message = 'Product Attribute has been deleted successfully!';
        session::flash('success_message',$message);
        return redirect()->back();
    }

   


}
