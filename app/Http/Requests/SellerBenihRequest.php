<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerBenihRequest extends FormRequest
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
            'judul'  => ['required', 'string'],
            'gambar' => [ (request()->isMethod('post') ? 'required' : ''), 'max:5120'],
            'kategori' => ['required', 'string'],
            'varietas' => ['required', 'string'],
            'umur' => ['required', 'numeric'],
            'potensi' => ['required', 'string'],
            'rekomendasi' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'variasi' => ['required', 'string'],
            'stok' => ['required', 'numeric'],
            'harga' => ['required', 'numeric']
        ];
    }
}
