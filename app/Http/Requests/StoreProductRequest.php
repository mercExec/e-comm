<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:100'],
            'price' => ['required', 'numeric', 'max_digits:15'],
            'description' => ['required'],
            'status' => ['required'],
            'images' => ($this->getMethod() == 'POST') ? ['required', 'max:5'] : '',
            'images.*' => ($this->getMethod() == 'POST') ? ['image', 'mimes:jpeg,png,jpg', 'max:5120','dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'] : '',
        ];
    }
}
