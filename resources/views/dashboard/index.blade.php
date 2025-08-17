@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<div class="max-w-3xl mx-auto mt-8">

    <div class="rounded-xl overflow-hidden shadow">
        <div class="h-28 bg-gradient-to-r from-indigo-500 via-sky-500 to-cyan-400"></div>

        <div class="bg-white p-6">
            @php
                $u = auth()->user();
                $initials = mb_strtoupper(mb_substr($u->name ?? '', 0, 1) . mb_substr($u->surname ?? '', 0, 1));
            @endphp

            <div class="-mt-14 mb-4 flex items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-gray-900 text-white flex items-center justify-center text-2xl font-bold shadow">
                    {{ $initials ?: 'U' }}
                </div>

                <div>
                    <h1 class="text-2xl font-bold">
                        {{ $u->name }} {{ $u->surname }}
                    </h1>
                    <p class="text-gray-500 text-sm">
                        Роль: <span class="font-medium">{{ $u->role->value ?? $u->role ?? '—' }}</span>
                    </p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <div class="text-gray-500">Логин</div>
                    <div class="font-medium">{{ $u->login ?? '—' }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Email</div>
                    <div class="font-medium">{{ $u->email }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Подтверждён</div>
                    <div class="font-medium">
                        {{ $u->email_verified_at ? $u->email_verified_at->format('d.m.Y H:i') : 'нет' }}
                    </div>
                </div>
                <div>
                    <div class="text-gray-500">Создан</div>
                    <div class="font-medium">{{ $u->created_at?->format('d.m.Y H:i') }}</div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('rooms.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Перейти к комнатам
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        Выйти
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
