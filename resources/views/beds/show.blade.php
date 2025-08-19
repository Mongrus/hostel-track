@extends('layouts.app')

@section('title', "Койка №{$bed->label} — Комната №{$room->number}")

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    @if (session('success'))
        <div class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex items-center justify-between">
        <nav class="text-sm text-gray-500">
            <a href="{{ route('rooms.index') }}" class="hover:underline">Комнаты</a>
            <span class="mx-1">/</span>
            <a href="{{ route('rooms.show', $room) }}" class="hover:underline">Комната №{{ $room->number ?? $room->id }}</a>
            <span class="mx-1">/</span>
            <span class="text-gray-700">Койка №{{ $bed->label ?? $bed->id }}</span>
        </nav>

        <div class="flex items-center gap-2">
            <a href="{{ route('beds.edit', [$room, $bed]) }}"
               class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                Редактировать
            </a>
            <a href="{{ route('rooms.show', $room) }}"
               class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm">
                Назад к комнате
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Койка №{{ $bed->label ?? $bed->id }}</h1>
                    <p class="text-gray-500">Комната №{{ $room->number ?? $room->id }}</p>
                </div>
                <span class="text-xs text-gray-400">
                    Обновлено: {{ $bed->updated_at?->format('d.m.Y H:i') ?? '—' }}
                </span>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <div class="text-xs uppercase tracking-wide text-gray-500">Номер койки</div>
                    <div class="text-gray-900 text-lg">{{ $bed->label ?? '—' }}</div>
                </div>

                <div class="space-y-1">
                    <div class="text-xs uppercase tracking-wide text-gray-500">ID</div>
                    <div class="text-gray-900 text-lg">{{ $bed->id }}</div>
                </div>

                <div class="md:col-span-2 space-y-1">
                    <div class="text-xs uppercase tracking-wide text-gray-500">Описание</div>
                    <div class="text-gray-900">{{ $bed->description ?: '—' }}</div>
                </div>

                <div class="space-y-1">
                    <div class="text-xs uppercase tracking-wide text-gray-500">Создано</div>
                    <div class="text-gray-900">{{ $bed->created_at?->format('d.m.Y H:i') ?? '—' }}</div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex items-center justify-between rounded-b-lg">
            <div class="text-sm text-gray-500">
                Комната: №{{ $room->number ?? $room->id }}
            </div>

            <form method="POST" action="{{ route('beds.destroy', [$room, $bed]) }}"
                  onsubmit="return confirm('Удалить эту койку? Это действие необратимо.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 text-sm">
                    Удалить
                </button>
            </form>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('beds.edit', [$room, $bed]) }}"
           class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
            Изменить данные
        </a>
        <a href="{{ route('beds.index', $room) }}"
           class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm">
            Все койки этой комнаты
        </a>
    </div>
</div>
@endsection
