@extends('layouts.app')

@section('title', "Комната №{$room->number}")

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">
        Комната №{{ $room->number }}
    </h1>

    <div class="bg-white shadow rounded p-6">
        <p><strong>Тип:</strong> {{ $room->type->value ?? $room->type }}</p>
        <p><strong>Описание:</strong> {{ $room->description ?? '—' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('rooms.index') }}" 
           class="text-blue-600 hover:underline">
            ← Назад к списку комнат
        </a>
    </div>
</div>
@endsection
