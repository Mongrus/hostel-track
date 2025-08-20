@extends('layouts.app')

@section('title', 'Компании')

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    @if (session('success'))
        <div class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    @php
        $isPaginator = $organizations instanceof \Illuminate\Contracts\Pagination\Paginator;
        $total = $isPaginator ? $organizations->total() : $organizations->count();
    @endphp

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Компании</h1>
            <p class="text-gray-500 text-sm">Всего: {{ $total }}</p>
        </div>

        @if (Route::has('organizations.create'))
            <a href="{{ route('organizations.create') }}"
               class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                Добавить компанию
            </a>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-left text-sm">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Название</th>
                    <th class="px-4 py-2 border-b">Телефон</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Владелец (ID)</th>
                    <th class="px-4 py-2 border-b">Описание</th>
                    <th class="px-4 py-2 border-b">Создано</th>
                    <th class="px-4 py-2 border-b">Действия</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse ($organizations as $org)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">{{ $org->id }}</td>
                        <td class="px-4 py-3 border-b font-medium text-gray-900">{{ $org->name ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">{{ $org->phone ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">{{ $org->email ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">{{ $org->owner_id ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">
                            <div class="truncate max-w-[32ch]" title="{{ $org->description }}">{{ $org->description ?? '—' }}</div>
                        </td>
                        <td class="px-4 py-3 border-b">{{ $org->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">
                            <div class="flex items-center gap-2">
                                @if (Route::has('organizations.show'))
                                    <a href="{{ route('organizations.show', $org) }}"
                                       class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                        Просмотр
                                    </a>
                                @endif
                                @if (Route::has('organizations.edit'))
                                    <a href="{{ route('organizations.edit', $org) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                        Редактировать
                                    </a>
                                @endif
                                @if (Route::has('organizations.destroy'))
                                    <form action="{{ route('organizations.destroy', $org) }}" method="POST"
                                          onsubmit="return confirm('Удалить компанию?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                            Удалить
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-6 text-center text-gray-500" colspan="8">
                            Компании не найдены.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($isPaginator)
        <div class="mt-4">
            {{ $organizations->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
