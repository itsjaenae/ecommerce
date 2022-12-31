<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $id = $this->brand ? ',' . $this->brand->id : '';
        $required = $this->brand ? '' : 'required';

        return [
            'photo'      => [$required,'mimes:jpeg,jpg,png,svg'],
            'name_en'      => 'required|max:255',
            'slug_en'      => [$required,'unique:brands,slug_en'. $id,'regex:/^[a-zA-Z0-9-]+$/'],
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
            'photo.required'  => __('Photo field is required.'),
            'photo.mimes'  => __('Photo file format not supported.'),
            'slug_en.required'  => __('Slug field is required.'),
            'slug_en.unique'    => __('This slug has already been taken.'),
            'slug_en.regex'     => __('Slug Must Not Have Any Special Characters.'),
        ];
    }
}
