<?php

namespace App\Repositories\Backend;

use App\{
    Models\Brand,
};
use App\Helpers\ImageHelper;

class BrandRepository
{

    /**
     * Store meal.
     *
     * @param  \App\Http\Requests\ImageStoreRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'images/brand_images');
        Brand::create($input);
    }

    /**
     * Update Brand.
     *
     * @param  \App\Http\Requests\ImageUpdateRequest  $request
     * @return void
     */

    public function update($brand, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/images/brand_images',$brand,'/images/brand_images/','photo');

        }
        $brand->update($input);
    }

    /**
     * Delete brand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($brand)
    {
        ImageHelper::handleDeletedImage($brand,'photo','images/brand_images/');
        $brand->delete();
    }

}
