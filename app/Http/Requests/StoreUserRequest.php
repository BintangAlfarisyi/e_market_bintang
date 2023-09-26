<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:30', 'string'],
            'email' => ['required', 'max:50', 'string'],
            'password' => ['required', 'min:8', 'string']
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Data nama belum diisi',
            'email.required' => 'Data email belum diisi',
            'password.required' => 'Data password belum diisi'
        ];
    }
}
