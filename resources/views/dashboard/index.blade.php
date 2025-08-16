@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">
        Добро пожаловать, {{ auth()->user()->name }}
    </h1>

    <div class="bg-white shadow rounded p-6">
        <p>Это ваша главная страница после входа.</p>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
            Выйти
        </button>
    </form>
</div>
@endsection

