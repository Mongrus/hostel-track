<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum as EnumRule;
use App\Enums\RoomType;

class UpdateRoomRequest extends FormRequest
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
        $roomId = $this->route('id');

        return [
            'number' => [
                'bail', 'required', 'integer', 'min:1',
                Rule::unique('rooms', 'number')->ignore($roomId),
            ],
            'type' => ['required', new EnumRule(RoomType::class)],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
