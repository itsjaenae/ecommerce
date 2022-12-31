<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryRequest extends FormRequest
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
        
        
        $required = $this->subcategory ? '' : 'required';
        
        return [
            'slug_en'  => [$required,'regex:/^[a-zA-Z0-9-]+$/'],
            'category_id'  => 'required',
            'subcategory_id'  => 'required',
            'name_en'  => 'required|max:255'
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
            'category_id.required'  => __('Category field is required.'),
            'subcategory_id.required'  => __('Subcategory field is required.'),
            'slug_en.required'  => __('Slug field is required.'),
            'slug_en.regex'     => __('Slug Must Not Have Any Special Characters.'),
        ];
    }
}
