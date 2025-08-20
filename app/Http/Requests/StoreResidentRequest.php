<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResidentRequest extends FormRequest
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
            'name'    => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'phone'   => ['required', 'string', 'max:50'],

            'organization_mode' => ['required', Rule::in(['none','existing','new'])],

            'organization_id' => [
                'exclude_unless:organization_mode,existing',
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'new_organization_name' => [
                'exclude_unless:organization_mode,new',
                'required',
                'string',
                'max:120',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'                   => 'имя',
            'surname'                => 'фамилия',
            'phone'                  => 'телефон',
            'organization_mode'      => 'режим организации',
            'organization_id'        => 'организация',
            'new_organization_name'  => 'новая организация',
        ];
    }

    public function messages(): array
    {
        return [
            'organization_mode.in' => 'Режим организации должен быть: none, existing или new.',
        ];
    }
}
