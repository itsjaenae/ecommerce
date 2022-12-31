<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        $type_required = $this->item_type == 'digital' || $this->item_type == 'license' ? '' : 'required';



        $check_link = $this->file_type == 'link' ? 'required' : '';
        if($this->item_type == 'digital'){
            if($this->item){
                $check_file = '';
            }else{
                $check_file = $this->item_type == 'digital' && $this->file_type == 'file' ? 'required' : '';
            }
        }elseif($this->item_type == 'license'){
            if($this->item){
                $check_file = '';
            }else{
                $check_file = $this->item_type == 'license' && $this->file_type == 'file' ? 'required' : '';
            }
        }else{
            $check_file = '';
        }
        $id = $this->item ? ',' . $this->item->id : '';
        $required = $this->item ? '' : 'required|';


        return [
            'name_en'            => 'required|max:255',
            'slug_en'            => 'required','unique:items,slug_en' . $id, 'regex:/^[a-zA-Z0-9-]+$/',
            'category_id'     => 'required',
            'details'         => 'required',
            'link'            => $check_link,
            'file'            => $check_file.'|file|mimes:zip',
            'sort_details'    => 'required',
            'discount_price'  => 'required|max:50',
            'previous_price'  => 'max:50',
            'stock'           => 'numeric|max:9999999999',
            'tax_id'          => 'required',
            'photo'           => 'nullable|mimes:jpeg,jpg,png,svg'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'name_en.required'            =>  __('Name field is required.'),
            'tax_id.required'          =>  __('Tax field is required.'),
            'category_id.required'     =>  __('Category field is required.'),
            'brand_id.required'        =>  __('Brand field is required.'),
            'slug_en.required'            =>  __('Slug field is required.'),
            'slug_en.unique'              =>  __('This slug has already been taken.'),
            'details.required'         =>  __('Description field is required.'),
            'sort_details.required'    =>  __('Sort Description field is required.'),
            'discount_price.required'  =>  __('Current Price field is required.'),
            'stock.required'           =>  __('Stock field is required.'),
            'photo.required'           =>  __('Image field is required.'),
            'photo.mimes'              =>  __('Image type must be jpg,jpeg,png,svg.')
        ];
    }

}
