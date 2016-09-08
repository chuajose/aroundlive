<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityForm extends FormRequest
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
        return [
            "user_id"        =>      "required",
            "description" => "required|between:5,255",
        ];
    }
 
    public function messages()
    {
        return [
            'user_id.required' => 'The :attribute is required!',
            'description.between' => 'The :attribute must be between :min - :max.',
            'description.required' => 'The :attribute is required!',
        ];
    }
}
