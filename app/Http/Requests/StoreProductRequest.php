<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'sku' => 'required|string|unique:products,sku' . ($this->product ? ',' . $this->product->id : ''),
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ];
        return $rules;
    }
}

