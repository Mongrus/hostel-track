@extends('layouts.app')

@section('title', "Организация #{$organization->id}" . ($organization->name ? " — {$organization->name}" : ''))

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">
            Организация #{{ $organization->id }}
            @if(!empty($organization->name))
                — {{ $organization->name }}
            @endif
        </h1>

        <div class="flex items-center gap-2">
            <a href="{{ route('organizations.index') }}" class="px-3 py-2 border rounded hover:bg-gray-50">
                ← К списку организаций
            </a>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow p-6 grid md:grid-cols-2 gap-6">
        <div>
            <div class="text-xs text-gray-500 uppercase">Название</div>
            <div class="text-lg">{{ $organization->name ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Телефон</div>
            <div class="text-lg">{{ $organization->phone ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Email</div>
            <div class="text-lg">{{ $organization->email ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Адрес</div>
            <div class="text-lg">{{ $organization->address ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">ИНН</div>
            <div class="text-lg">{{ $organization->inn ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">ОГРН</div>
            <div class="text-lg">{{ $organization->ogrn ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Веб-сайт</div>
            <div class="text-lg">
                {{ $organization->website ?? '—' }}
            </div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Владелец (owner_id)</div>
            <div class="text-lg">{{ $organization->owner_id ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Создано</div>
            <div class="text-lg">{{ $organization->created_at?->format('d.m.Y H:i') ?? '—' }}</div>
        </div>

        <div>
            <div class="text-xs text-gray-500 uppercase">Обновлено</div>
            <div class="text-lg">{{ $organization->updated_at?->format('d.m.Y H:i') ?? '—' }}</div>
        </div>
    </div>
</div>
@endsection
