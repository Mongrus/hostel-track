@extends('layouts.app')

@section('content')
@if (session('status'))
  <div class="alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ url('/login') }}">
  @csrf

  <label for="email">E-mail *</label>
  <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
  @error('email') <div class="error">{{ $message }}</div> @enderror

  <label for="password">Пароль *</label>
  <input id="password" type="password" name="password" required>
  @error('password') <div class="error">{{ $message }}</div> @enderror

  <label>
    <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
    Запомнить меня
  </label>

  <button type="submit">Войти</button>
</form>
@endsection
