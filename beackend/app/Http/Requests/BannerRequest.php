<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;  

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BannerRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'cta' => 'nullable|string|max:100',
            'cta_url' => 'nullable|string|max:255',
            'position' => ['nullable', Rule::in(['top', 'middle', 'bottom'])],
            'type' => ['nullable', Rule::in(['slider', 'popup', 'static'])],
            'order' => 'nullable|integer',
            'status' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,avif|max:20048',
//'image' => 'nullable|file|mimetypes:image/avif,image/jpeg,image/png,image/webp|mimes:avif,jpeg,png,webp|max:2048',
        ];
    }

     protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            // response()->json([
            //     'success' => false,
            //     'message' => 'Validation errors',
            //     'errors' => $validator->errors()
            // ], 422)
            error('Validation errors', 422, $validator->errors())
        );
    }
}
