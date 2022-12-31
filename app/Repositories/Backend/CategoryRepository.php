<?php

namespace App\Repositories\Backend;

use App\{
    Models\Category,
    Helpers\ImageHelper
};
use App\Models\HomeCustomize;

class CategoryRepository
{

    /**
     * Store category.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return void
     */

    public function store($request)
    {
        $input = $request->all();
        $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'images/category_images');
        Category::create($input);
    }

    /**
     * Update category.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return void
     */

    public function update($category, $request)
    {
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/images/category_images/',$category,'/images/category_images/','photo');
        }
        $category->update($input);
    }

    /**
     * Delete category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($category)
    {
        if(isset($home)){
        $home = HomeCustomize::first();
        $popular_category = json_decode($home['popular_category'],true);
        $feature_category = json_decode($home['feature_category'],true);
        $two_column_category = json_decode($home['two_column_category'],true);
        $home_4_popular_category = json_decode($home['home_4_popular_category'],true);
        $check = false;
      
        for($i=1;$i<5;$i++){
            if($popular_category['category_id'.$i] == $category->id){
                $check = true;
            }
        }

        for($i=1;$i<5;$i++){
           
            if($feature_category['category_id'.$i] == $category->id){
                $check = true;
            }

        }
        for($i=1;$i<3;$i++){
           
            if($two_column_category['category_id'.$i] == $category->id){
                $check = true;
            }

        }
   
        if(isset($home_4_popular_category)){
            if(in_array($category->id,$home_4_popular_category)){
                $check =  true;
            }
        }
    }
    $check = false;
       if($check){
           return ['message' => __('This Category already used Home page section . Please change this category then delete this category') , 'status' => 0];
       }else{
        ImageHelper::handleDeletedImage($category,'photo','images/category_images/');
        $category->delete();
        return ['message' => __('Category Deleted Successfully.'),'status' => 1];
       }
     

    }

}
