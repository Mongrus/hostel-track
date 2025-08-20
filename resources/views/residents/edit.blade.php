@extends('layouts.app')

@section('title', "Редактировать жильца #{$resident->id}")

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
        <h1 class="text-2xl font-bold">Редактировать жильца #{{ $resident->id }}</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('residents.show', $resident) }}" class="px-3 py-2 border rounded hover:bg-gray-50 text-sm">
                ← Карточка жильца
            </a>
            <a href="{{ route('residents.index') }}" class="px-3 py-2 border rounded hover:bg-gray-50 text-sm">
                Список
            </a>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <form method="POST" action="{{ route('residents.update', $resident) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-gray-600 mb-1">Фамилия *</label>
                <input name="surname"
                       value="{{ old('surname', $resident->surname) }}"
                       class="border rounded px-3 py-2 w-full" required>
                @error('surname')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Имя *</label>
                <input name="name"
                       value="{{ old('name', $resident->name) }}"
                       class="border rounded px-3 py-2 w-full" required>
                @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Телефон *</label>
                <input name="phone"
                       value="{{ old('phone', $resident->phone) }}"
                       class="border rounded px-3 py-2 w-full" required>
                @error('phone')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="pt-2 border-t">
                <label class="block text-sm text-gray-600 mb-1">Организация</label>
                <select name="organization_id" class="border rounded px-3 py-2 w-full">
                    <option value="">— без организации —</option>
                    @foreach(($organizations ?? []) as $org)
                        <option value="{{ $org->id }}"
                            @selected(old('organization_id', $resident->organization_id) == $org->id)>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
                @error('organization_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Сохранить
                </button>
                <a href="{{ route('residents.show', $resident) }}" class="px-4 py-2 rounded border hover:bg-gray-50">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
