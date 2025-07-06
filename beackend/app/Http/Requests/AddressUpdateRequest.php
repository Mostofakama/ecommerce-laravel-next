<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class AddressUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['sometimes', Rule::in(['billing', 'shipping'])],
            'label' => ['nullable', 'string', 'max:100'],
            'name' => ['sometimes', 'string', 'max:100'],
            'phone' => ['sometimes', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'country_code' => ['sometimes', 'string', 'max:10'],
            'division_id' => ['sometimes', Rule::exists('divisions', 'id')],
            'district_id' => ['sometimes', Rule::exists('districts', 'id')],
            'upazila_id' => ['sometimes', Rule::exists('upazilas', 'id')],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'street_address' => ['sometimes', 'string'],
            'landmark' => ['nullable', 'string', 'max:150'],
            'is_default' => ['boolean'],
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
