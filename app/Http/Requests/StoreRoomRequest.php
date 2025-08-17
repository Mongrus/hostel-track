<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum as EnumRule;
use App\Enums\RoomType;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number' => ['bail', 'required', 'integer', Rule::unique('rooms', 'number')],
            'type' => ['required', new EnumRule(RoomType::class)],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'number' => $this->number !== null ? (int) $this->number : null,
            'description' => $this->description ? trim($this->description) : null,
        ]);
    }

    public function attributes(): array
    {
        return [
            'number' => 'Номер комнаты',
            'type' => 'Тип комнаты',
            'description' => 'Описание',
        ];
    }

    public function messages(): array
    {
        return [
            'number.unique' => 'Комната с таким номером уже существует.',
        ];
    }
}
