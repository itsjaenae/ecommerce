<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateRequest extends FormRequest
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


        $id = $this->affiliate ? ',' . $this->affiliate->id : '';
        $required = $this->affiliate ? '' : 'required|';

        return [
            'name_en'            => 'required|max:255',
            'slug_en'            => 'required','unique:items,slug_en' . $id, 'regex:/^[a-zA-Z0-9-]+$/',
            'category_id'     => 'required',
            'details'         => 'required',
            'affiliate_link'  => 'required',
            'sort_details'    => 'required',
            'discount_price'  => 'required|max:50',
            'previous_price'  => 'max:50',
            'photo'           => $required, 'mimes:jpeg,jpg,png,svg'
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
            'affiliate_link.required'  =>  __('Affiliate link is required.'),
            'category_id.required'     =>  __('Category field is required.'),
            'brand_id.required'        =>  __('Brand field is required.'),
            'slug_en.required'            =>  __('Slug field is required.'),
            'slug_en.unique'              =>  __('This slug has already been taken.'),
            'details.required'         =>  __('Description field is required.'),
            'sort_details.required'    =>  __('Sort Description field is required.'),
            'discount_price.required'  =>  __('Current Price field is required.'),
            'photo.required'           =>  __('Image field is required.'),
            'photo.mimes'              =>  __('Image type must be jpg,jpeg,png,svg.')
        ];
    }

}
