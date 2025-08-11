@if (session('status'))
    <div class="alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">Имя *</label>
    <input id="name" name="name" value="{{ old('name') }}" required>

    <label for="surname">Фамилия</label>
    <input id="surname" name="surname" value="{{ old('surname') }}">

    <label for="login">Логин *</label>
    <input id="login" name="login" value="{{ old('login') }}" required>

    <label for="email">E-mail *</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>

    <label for="role">Роль *</label>
    <select id="role" name="role" required>
        <option value="" disabled selected>Выберите роль</option>
        <option value="{{ \App\Enums\UserRole::EMPLOYEE->value }}">Сотрудник</option>
        <option value="{{ \App\Enums\UserRole::VISITOR->value }}">Посетитель</option>
    </select>

    <label for="password">Пароль *</label>
    <input id="password" type="password" name="password" required>

    <label for="password_confirmation">Подтверждение пароля *</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required>

    <button type="submit">Зарегистрироваться</button>

    @foreach ($errors->all() as $e)
        <div class="error">{{ $e }}</div>
    @endforeach
</form>
