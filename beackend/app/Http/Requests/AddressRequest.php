<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;  // <-- এটা যোগ করতে হবে

class AddressRequest extends FormRequest
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
            'type' => ['required', Rule::in(['billing', 'shipping'])],
            'label' => ['nullable', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'country_code' => ['required', 'string', 'max:10'],
            'division_id' => ['required', Rule::exists('divisions', 'id')],
            'district_id' => ['required', Rule::exists('districts', 'id')],
            'upazila_id' => ['required', Rule::exists('upazilas', 'id')],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'street_address' => ['required', 'string'],
            'landmark' => ['nullable', 'string', 'max:150'],
            'is_default' => ['boolean']
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
