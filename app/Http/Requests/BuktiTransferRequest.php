<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuktiTransferRequest extends FormRequest
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
            'rek_name' => 'required|max:40',
            'rek_number' => 'required|string|regex:/^[0-9]+$/|min:9|max:20',
            'proof_of_payment' => 'required|mimes:bmp,jpeg,png,jpg|max:3024'
        ];
    }

    /**
     * Get the validation rules messages for display.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rek_name.required' => 'Rekening A/N wajib diisi!',
            'rek_name.max' => 'Maksimal 40 Karakter',
            'rek_number.required' => 'Nomor Rekening wajib diisi!',
            'rek_number.max' => 'Maksimal 20 Karakter NUmber',
            'rek_number.regex' => 'Isian harus berupa Nomor',
            'proof_of_payment.required' => 'Bukti Tranfer wajib di upload!',
            'proof_of_payment.mimes' => 'file harus berupa bmp,jpeg,png,jpg',
            'proof_of_payment.max' => 'file upload Maksimal 3MB'
        ];
    }
}
