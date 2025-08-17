<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBedRequest extends FormRequest
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
                    'beds' => ['required', 'array', 'min:1'],
                    'beds.*' => ['required', 'string', 'max:50'],

                    'descriptions' => ['nullable', 'array'],
                    'descriptions.*' => ['nullable', 'string', 'max:255'],
                ];
    }
}
