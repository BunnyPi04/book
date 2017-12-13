<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCheck extends FormRequest
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
            'emp_name'=>'required',
            'emp_username'=>'required',
            'emp_pass'=>'required',
            'emp_phone_number'=>'required',
            'emp_position'=>'required',
            'emp_active'=>'required'
        ];
    }
}
