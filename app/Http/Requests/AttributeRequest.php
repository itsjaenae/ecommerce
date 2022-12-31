<?php

namespace App\Http\Requests;

use Illuminate\{
    Validation\Rule,
    Foundation\Http\FormRequest
};

class AttributeRequest extends FormRequest
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

        $data = $this->request->all();

        $id = $this->attribute ? $this->attribute->id : '';

        return  [
            'name' => 'required|max:100',Rule::unique('attributes', 'name')->where(function ($query) use ($data) {
                return $query->where('product_id', $data['product_id']);
            })->ignore($id),
     
            // 'size' => 'required|max:100',Rule::unique('attributes', 'size')->where(function ($query) use ($data) {
            //     return $query->where('product_id', $data['product_id']);
            // })->ignore($id)
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
            'name.required' => __('name field is required.'),
          //  'size.required' => __('size field is required.'),
          //  'size.unique'   => __('This size has already been taken.'),
            'name.unique'   => __('This name has already been taken.'),
        ];
    }


}
