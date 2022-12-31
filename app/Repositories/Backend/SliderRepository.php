<?php

namespace App\Repositories\Backend;

use App\{
    Models\Slider,
    Helpers\ImageHelper
};

class SliderRepository
{

    /**
     * Store slider.
     *
     * @param  \App\Http\Requests\ImageStoreRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'images/slider_images');
        $input['logo'] = ImageHelper::handleUploadedImage($request->file('logo'),'images/slider_images');
        Slider::create($input);
    }

    /**
     * Update slider.
     *
     * @param  \App\Http\Requests\ImageUpdateRequest  $request
     * @return void
     */

    public function update($slider, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/images/slider_images/',$slider,'/images/slider_images/','photo');
        }
        if ($file = $request->file('logo')) {
            $input['logo'] = ImageHelper::handleUpdatedUploadedImage($file,'/images/slider_images/',$slider,'/images/slider_images/','logo');
        }
        $slider->update($input);
    }

    /**
     * Delete slider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($slider)
    {
        ImageHelper::handleDeletedImage($slider,'photo','images/slider_images/');
        ImageHelper::handleDeletedImage($slider,'logo','images/slider_images/');
        $slider->delete();
    }

}
