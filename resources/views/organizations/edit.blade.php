@extends('layouts.app')

@section('title', "Редактировать организацию #{$organization->id}")

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    @if ($errors->any())
        <div class="rounded-md bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
            <div class="font-semibold mb-1">Проверьте поля формы:</div>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">
            Редактировать организацию #{{ $organization->id }}
            @if($organization->name) — {{ $organization->name }} @endif
        </h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('organizations.show', $organization) }}" class="px-3 py-2 border rounded hover:bg-gray-50 text-sm">
                ← Карточка организации
            </a>
            <a href="{{ route('organizations.index') }}" class="px-3 py-2 border rounded hover:bg-gray-50 text-sm">
                Список
            </a>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <form method="POST" action="{{ route('organizations.update', $organization) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-gray-600 mb-1">Название *</label>
                <input name="name"
                       value="{{ old('name', $organization->name) }}"
                       class="border rounded px-3 py-2 w-full" required>
                @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Телефон</label>
                <input name="phone"
                       value="{{ old('phone', $organization->phone) }}"
                       class="border rounded px-3 py-2 w-full">
                @error('phone')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $organization->email) }}"
                       class="border rounded px-3 py-2 w-full">
                @error('email')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Описание</label>
                <textarea name="description" rows="4" class="border rounded px-3 py-2 w-full">{{ old('description', $organization->description) }}</textarea>
                @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Сохранить
                </button>
                <a href="{{ route('organizations.show', $organization) }}" class="px-4 py-2 rounded border hover:bg-gray-50">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
