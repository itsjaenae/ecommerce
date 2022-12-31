<?php

namespace App\Repositories\Backend;

use App\{
    Models\Product,
    Models\Gallery,
    Helpers\ImageHelper
};
use App\Models\Currency;

class ProductRepository
{

    /**
     * Store item.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return void
     */

    public function store($request)
    {
        
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $images_name = ImageHelper::ItemhandleUploadedImage($request->file('photo'),'images/product_images');
  
            $input['photo'] = $images_name[0];
            $input['thumbnail'] = $images_name[1];
        }

        $curr = Currency::where('is_default',1)->first();
        $input['discount_price'] = $request->discount_price / $curr->value;
        $input['previous_price'] = $request->previous_price / $curr->value;

        if($request->has('meta_keywords')){
            $input['meta_keywords'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->meta_keywords);
        }

        if($request->has('is_social')){
            $input['social_icons'] = json_encode($input['social_icons']);
            $input['social_links'] = json_encode($input['social_links']);
        }else{
            $input['is_social']    = 0;
            $input['social_icons'] = null;
            $input['social_links'] = null;
        }

        if($request->has('tags')){
            $input['tags'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->tags);
        }

        if($request->has('is_specification')){
            $input['specification_name'] = json_encode($input['specification_name']);
            $input['specification_description'] = json_encode($input['specification_description']);
        }else{
            $input['is_specification']    = 0;
            $input['specification_name'] = null;
            $input['specification_description'] = null;
        }

        if($request->has('license_name') && $request->has('license_key')){
            $input['license_name'] = json_encode($input['license_name']);
            $input['license_key'] = json_encode($input['license_key']);
        }else{
            $input['license_name'] = null;
            $input['license_key'] = null;
        }

        // digital product file upload
        if($request->item_type == 'digital'){
            if($request->hasFile('file')){
                $file = $request->file;
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/files',$name);
                $input['file'] = $name;
            }
        }

        if($request->item_type == 'license'){
            if($request->hasFile('file')){
                $file = $request->file;
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/files',$name);
                $input['file'] = $name;
            }
        }
 
        if($request->has('pspecial_offer') ){
            $input['pspecial_offer'] = $request->pspecial_offer;
        }  else{
            $input['pspecial_offer']    = 0;
        } 

        if($request->has('phot_deals')){
            $input['phot_deals'] = $request->phot_deals;
        } else{
            $input['phot_deals']    = 0;
        } 

     if($request->has('pspecial_deals') ){
        $input['pspecial_deals'] = $request->pspecial_deals;
    } else{
        $input['pspecial_deals']    = 0;

    } 
        if($request->has('pfeatured')){
            $input['pfeatured'] = $request->pfeatured;
        } else{
            $input['pfeatured']    = 0;
        } 


 
         

        $input['is_type'] = 'undefine';

        $product_id = Product::create($input)->id;

        if(isset($input['galleries'])){
            $this->galleriesUpdate($request,$product_id);
        }

        return $product_id;

    }

    /**
     * Update item.
     *
     * @param  \App\Http\Requests\ItemRequest  $request
     * @return void
     */

    public function update($product,$request)
    {
        $input = $request->all();

        if ( $request->file('photo')) {

            $images_name = ImageHelper::ItemhandleUpdatedUploadedImage($request->photo,'/images/product_images',$product,'/images/product_images/','photo');
            $input['photo'] = $images_name[0];
            $input['thumbnail'] = $images_name[1];
        }


        if($request->has('meta_keywords')){
            $input['meta_keywords'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->meta_keywords);
        }

        $curr = Currency::where('is_default',1)->first();
        $input['discount_price'] = $request->discount_price / $curr->value;
        $input['previous_price'] = $request->previous_price / $curr->value;


        if($request->has('is_social')){
            $input['social_icons'] = json_encode($input['social_icons']);
            $input['social_links'] = json_encode($input['social_links']);
        }else{
            $input['is_social']    = 0;
            $input['social_icons'] = null;
            $input['social_links'] = null;
        }

        if($request->has('tags')){
            $input['tags'] = str_replace(["value", "{", "}", "[","]",":","\""], '', $request->tags);
        }

        if($request->has('is_specification')){
            $input['specification_name'] = json_encode($input['specification_name']);
            $input['specification_description'] = json_encode($input['specification_description']);
        }else{
            $input['is_specification']    = 0;
            $input['specification_name'] = null;
            $input['specification_description'] = null;
        }

        if($request->has('license_name') && $request->has('license_key')){
            $input['license_name'] = json_encode($input['license_name']);
            $input['license_key'] = json_encode($input['license_key']);
        }else{
            $input['license_name'] = null;
            $input['license_key'] = null;
        }


        if($request->item_type == 'digital'){
            if(!$request->hasFile('file')){
                if($request->link){
                    if(file_exists('assets/files/'.$product->file)){
                        unlink('assets/files/'.$product->file);
                    }
                    $input['file'] = null;
                }
            }
        }
        // digital product file upload
        if($request->item_type == 'digital'){
            if($request->hasFile('file')){
                if($product->file){
                    if(file_exists('assets/files/'.$product->file)){
                        unlink('assets/files/'.$product->file);
                    }
                }

                $file = $request->file;
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/files',$name);
                $input['file'] = $name;
                $input['link'] = null;
            }
        }

        if($request->has('pspecial_offer') ){
            $input['pspecial_offer'] = $request->pspecial_offer;
          }else{
            $input['pspecial_offer']    = 0;
        } 

        if($request->has('phot_deals')){
            $input['phot_deals'] = $request->phot_deals;
          }else{
            $input['phot_deals']    = 0;
        } 

     if($request->has('pspecial_deals') ){
        $input['pspecial_deals'] = $request->pspecial_deals;
     }else{
        $input['pspecial_deals']    = 0;
    } 

        if($request->has('pfeatured')){
            $input['pfeatured'] = $request->pfeatured;
       }else{
            $input['pfeatured']    = 0;
        } 


        // if($request->has('fabric_id')){
        //     $input['fabric_id'] = $request->fabric_id;
        // } else{
        //     $input['fabric_id']    = Null;
        // } 

        

        $product->update($input);
        if(isset($input['galleries'])){
            $this->galleriesUpdate($request,$product->id);
        }
    }

    public function highlight($product,$request)
    {
        $input = $request->all();
        if($request->is_type != 'flash_deal'){
            $input['date'] = null;
        }
        $product->update($input);
    }

    /**
     * Delete item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($product)
    {
        if($product->galleries()->count() > 0){
            foreach($product->galleries as $gallery){
                $this->galleryDelete($gallery);
            }
        }

        if($product->campaigns->count() > 0){
            $product->campaigns()->delete();
         }

        if($product->reviews->count() > 0){
            $product->reviews()->delete();
        }

        if($product->attributes()->count() > 0){
          
            $product->attributes()->delete();
        }

        ImageHelper::handleDeletedImage($product,'photo','images/product_images/');
        ImageHelper::handleDeletedImage($product,'thumbnail','images/product_images/');
        if($product->item_type == 'digital' && $product->file){
            ImageHelper::handleDeletedImage($product,'file','assets/files/');
        }
        $product->delete();
    }

    /**
     * Update gallery.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @return void
     */

    public function galleriesUpdate($request,$product_id=null)
    {
        Gallery::insert($this->storeImageData($request,$product_id));
    }

    /**
     * Delete gallery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function galleryDelete($gallery)
    {
        ImageHelper::handleDeletedImage($gallery,'photo','/images/product_images/');
        $gallery->delete();
    }

    /**
     * Custom Function.
     * @return void
     */

    public function storeImageData($request,$product_id=null)
    {
        $storeData = [];
        if ($galleries = $request->file('galleries')) {
            foreach($galleries as $key => $gallery){
                $storeData[$key] = [
                    'photo'=>  ImageHelper::handleUploadedImage($gallery,'images/product_images'),
                    'product_id' => $product_id ? $product_id : $request['product_id'],
                ];
            }
        }
        return $storeData;
    }

}
