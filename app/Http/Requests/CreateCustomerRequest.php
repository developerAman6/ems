<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'soe' => 'required',
  //          'emp_id' => 'required',
            'name' => 'required|min:3',
            'mob' => 'required|min:10',
            'brand' => 'required',
            'model' => 'required',
            'mop' => 'required',
            'status' => 'required',
        ];
    }
}
