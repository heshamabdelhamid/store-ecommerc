<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'يجب ادخال البريد الالكتروني',
            'email.email'       => 'يجب ادخال صيغة صحيحه للبريد الالكتروني ',
            'password.required' => ' يجب ادخال كلمة المرور ',
        ];

    }
}