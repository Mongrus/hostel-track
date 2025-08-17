@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
  <div class="w-full max-w-xl">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
      <div class="h-28 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400"></div>

      <div class="p-8">
        <h1 class="text-2xl font-bold mb-6">Создать аккаунт</h1>

        @if (session('status'))
          <div class="mb-4 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}" novalidate>
          @csrf

          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Имя *</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name') }}" required
                   class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="mb-4">
            <label for="surname" class="block text-sm font-medium text-gray-700">Фамилия</label>
            <input id="surname" name="surname" type="text"
                   value="{{ old('surname') }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
            @error('surname') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="mb-4">
            <label for="login" class="block text-sm font-medium text-gray-700">Логин *</label>
            <input id="login" name="login" type="text"
                   value="{{ old('login') }}" required
                   class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
            @error('login') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">E‑mail *</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email') }}" required
                   class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Роль *</label>
            <select id="role" name="role" required
                    class="mt-1 block w-full rounded-lg border-gray-300 bg-white focus:border-indigo-500 focus:ring-indigo-500">
              <option value="" disabled {{ old('role') ? '' : 'selected' }}>Выберите роль</option>
              <option value="{{ \App\Enums\UserRole::EMPLOYEE->value }}" {{ old('role') === \App\Enums\UserRole::EMPLOYEE->value ? 'selected' : '' }}>Сотрудник</option>
              <option value="{{ \App\Enums\UserRole::VISITOR->value }}"  {{ old('role') === \App\Enums\UserRole::VISITOR->value  ? 'selected' : '' }}>Посетитель</option>
            </select>
            @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Пароль *</label>
            <div class="relative">
              <input id="password" name="password" type="password" required
                     class="mt-1 block w-full rounded-lg border-gray-300 pr-10 focus:border-indigo-500 focus:ring-indigo-500" />
              <button type="button" onclick="togglePwd('password', this)"
                      class="absolute right-2 top-1/2 -translate-y-1/2 text-sm text-gray-500 hover:text-gray-700">Показать</button>
            </div>
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтверждение пароля *</label>
            <div class="relative">
              <input id="password_confirmation" name="password_confirmation" type="password" required
                     class="mt-1 block w-full rounded-lg border-gray-300 pr-10 focus:border-indigo-500 focus:ring-indigo-500" />
              <button type="button" onclick="togglePwd('password_confirmation', this)"
                      class="absolute right-2 top-1/2 -translate-y-1/2 text-sm text-gray-500 hover:text-gray-700">Показать</button>
            </div>
          </div>

          <button type="submit"
                  class="w-full py-3 px-4 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700">
            Зарегистрироваться
          </button>

          @if ($errors->any())
            <div class="mt-4 space-y-1">
              @foreach ($errors->all() as $e)
                <p class="text-sm text-red-600">• {{ $e }}</p>
              @endforeach
            </div>
          @endif
        </form>
      </div>
    </div>

    <p class="text-center text-sm text-gray-500 mt-4">
      Уже есть аккаунт?
      <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Войти</a>
    </p>
  </div>
</div>

<script>
function togglePwd(id, btn){
  const el = document.getElementById(id);
  const isPwd = el.type === 'password';
  el.type = isPwd ? 'text' : 'password';
  btn.textContent = isPwd ? 'Скрыть' : 'Показать';
}
</script>
@endsection
