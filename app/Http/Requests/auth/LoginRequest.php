<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Get the validation Message.
     *
     * @return array
     * @author Rangga Darmajati < WA: 085721731478, EMAIL: rangga.android69@gmail.com >
     */

    public function messages()
    {
        return [
            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Alamat Email tidak valid',
            'password.required' => 'Password harus diisi!',
        ];
    }
}
