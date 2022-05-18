<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'minPrice' => 'integer',
			'maxPrice' => 'integer',
			'categoryId' => 'exists:categories,id',
			'available' => 'boolean'
        ];
    }
}
