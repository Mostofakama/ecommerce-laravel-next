<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductRequestStore extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'summary' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            //'discount_type' => 'nullable|in:none,fixed,percentage',
           // 'discount_value' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'new_product' => 'boolean',
            'best_seller' => 'boolean',

            // Image gallery
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',

            // Variants
            'variants' => 'nullable|array',
            'variants.*.color' => 'nullable|string|max:100',
            'variants.*.size' => 'nullable|string|max:100',
            'variants.*.quantity' => 'required|integer|min:0',
        ];
    }

     protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
