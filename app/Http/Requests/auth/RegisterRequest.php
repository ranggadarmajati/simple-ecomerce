<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
            'first_name.required' => 'Nama Depan Harus diisi!',
            'first_name.max' => 'Nama Depan maksimal 25 Karakter!',
            'last_name.required' => 'Nama Belakang Harus diisi!',
            'last_name.max' => 'Nama Belakang maksimal 25 Karakter!',
            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Alamat Email tidak valid',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Password tidak sesuai!',
            'password.min' => 'Password minimal 6 karakter!'
        ];
    }
}
