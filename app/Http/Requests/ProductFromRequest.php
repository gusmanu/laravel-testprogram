<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductFromRequest extends FormRequest
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
            'nama_produk' => 'required|string|min:3|max:255',
            'harga' => 'required|integer|min:0',
            'kategori' => 'required|string|min:3|max:255',
            'status' => ['required', Rule::in(['bisa dijual', 'tidak bisa dijual'])]
        ];
    }
}
