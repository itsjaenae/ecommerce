<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

        $id = $this->category ? ',' . $this->category->id : '';
        $required = $this->category ? '' : 'required';

        return [
            'slug_en'      => [$required,'unique:categories,slug_en'. $id,'regex:/^[a-zA-Z0-9-]+$/'],
            'photo'     => [$required,'mimes:jpeg,jpg,png,svg'],
            'name_en'      => 'required|max:255',
            'meta_keywords'=> 'max:255',
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
            'slug_en.required'  => __('Slug field is required.'),
            'slug_en.unique'    => __('This slug has already been taken.'),
            'slug_en.regex'     => __('Slug Must Not Have Any Special Characters.'),
            'photo.required' => __('Image field is required.'),
            'photo.mimes'    => __('Image type must be jpg,jpeg,png,svg.'),
        ];
    }
}
