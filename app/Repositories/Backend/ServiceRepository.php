<?php

namespace App\Repositories\Backend;

use App\{
    Models\Service,
    Helpers\ImageHelper
};

class ServiceRepository
{

    /**
     * Store service.
     *
     * @param  \App\Http\Requests\ImageStoreRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'images/services_images');
        Service::create($input);
    }

    /**
     * Update service.
     *
     * @param  \App\Http\Requests\ImageUpdateRequest  $request
     * @return void
     */

    public function update($service, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/images/services_images',$service,'/images/services_images/','photo');
        }
        $service->update($input);
    }

    /**
     * Delete service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($service)
    {
        ImageHelper::handleDeletedImage($service,'photo','images/services_images/');
        $service->delete();
    }

}
