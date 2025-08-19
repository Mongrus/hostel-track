@extends('layouts.app')

@section('title', "Жилец #{$resident->id}")

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Жилец #{{ $resident->id }}</h1>
        <a href="{{ route('residents.index') }}" class="px-3 py-2 border rounded hover:bg-gray-50">
            ← К списку жильцов
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow p-6 grid md:grid-cols-2 gap-6">
        <div>
            <div class="text-xs text-gray-500 uppercase">Фамилия</div>
            <div class="text-lg">{{ $resident->surname ?? '—' }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500 uppercase">Имя</div>
            <div class="text-lg">{{ $resident->name ?? '—' }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500 uppercase">Телефон</div>
            <div class="text-lg">{{ $resident->phone ?? '—' }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500 uppercase">Организация ID</div>
            <div class="text-lg">{{ $resident->organization_id ?? '—' }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500 uppercase">Создан</div>
            <div class="text-lg">{{ $resident->created_at?->format('d.m.Y H:i') ?? '—' }}</div>
        </div>
        <div>
            <div class="text-xs text-gray-500 uppercase">Обновлён</div>
            <div class="text-lg">{{ $resident->updated_at?->format('d.m.Y H:i') ?? '—' }}</div>
        </div>
    </div>
</div>
@endsection
