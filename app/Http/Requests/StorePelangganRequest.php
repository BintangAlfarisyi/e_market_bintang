<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_pelanggan' => ['required'],
            'nama_pelanggan' => ['required', 'max:30', 'string'],
            'alamat' => ['required', 'max:100', 'string'],
            'no_telp' => ['required', 'numeric'],
            'email' => ['required', 'max:50', 'string']
        ];
    }

    public function messages(){
        return[
            'kode_pelanggan.required' => 'Data kode pelanggan belum diisi!',
            'nama_pelanggan.required' => 'Data nama belum diisi!',
            'alamat.required' => 'Data alamat barang belum diisi!',
            'no_telp.required' => 'Data no telp barang belum diisi!',
            'email.required' => 'Data email barang belum diisi!'
        ];
    }
}
