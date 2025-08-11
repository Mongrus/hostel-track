<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required','string','email:rfc,dns','max:255'],
            'password' => ['required','string','min:6'],
            'remember' => ['sometimes','boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('email')) {
            $this->merge(['email' => mb_strtolower(trim((string)$this->input('email')))]);
        }
        $this->merge(['remember' => (bool)$this->input('remember')]);
    }

    public function payload(): array
    {
        $v = $this->validated();
        return ['email' => $v['email'], 'password' => $v['password'], 'remember' => $v['remember'] ?? false];
    }
}
