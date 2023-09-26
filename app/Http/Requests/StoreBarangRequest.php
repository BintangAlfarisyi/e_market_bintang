<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
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
            'kode_barang' => ['required',],
            'nama_barang' => ['required', 'max:50', 'string'],
            'satuan' => ['required', 'max:10', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'ditarik' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:user,id'],
            'produk_id' => ['required', 'exists:produk,id']
        ];
    }
    
    public function messages(){
        return[
            'kode_barang.required' => 'Data kode barang belum diisi!',
            'nama_barang.required' => 'Data nama barang belum diisi!',
            'satuan.required' => 'Data saruan barang belum diisi!',
            'harga_jual.required' => 'Data harga jual barang belum diisi!',
            'stok.required' => 'Data stok barang belum diisi!',
            'ditarik.required' => 'Data ditarik barang belum diisi!',
            'user_id.required' => 'Data user id barang belum diisi!',
            'produk_id.required' => 'Data produk id barang belum diisi!'
        ];
    }
}
