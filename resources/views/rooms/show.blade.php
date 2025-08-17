@extends('layouts.app')

@section('title', "Комната №{$room->number}")

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">
        Комната №{{ $room->number }}
    </h1>

    @if (session('success'))
        <div class="mb-6 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 space-y-2">
        <p><strong>Тип:</strong> {{ $room->type->value ?? $room->type }}</p>
        <p><strong>Описание:</strong> {{ $room->description ?? '—' }}</p>
        <p><strong>Количество коек:</strong> {{ $room->beds_count }}</p>

        <a href="{{ route('beds.index', $room->id) }}"
           class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Смотреть все койки ({{ $room->beds_count }})
        </a>
    </div>

    <div class="mt-6 flex items-center gap-4">
        <a href="{{ route('rooms.edit', $room->id) }}" 
           class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
            Редактировать
        </a>

        <form action="{{ route('rooms.destroy', $room->id) }}" 
              method="POST" 
              onsubmit="return confirm('Удалить эту комнату?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Удалить
            </button>
        </form>

        <a href="{{ route('rooms.index') }}" 
           class="text-blue-600 hover:underline">
            ← Назад к списку комнат
        </a>
    </div>
</div>
@endsection
