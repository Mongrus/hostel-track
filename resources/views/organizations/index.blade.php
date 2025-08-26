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

    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold">Компании</h1>
            <p class="text-gray-500 text-sm">Всего: {{ $total }}</p>
        </div>

        @if (Route::has('organizations.create'))
            <a href="{{ route('organizations.create') }}"
               class="shrink-0 px-3 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                Добавить компанию
            </a>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow">
        <table class="min-w-full table-fixed text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="w-14 px-3 py-2 border-b">ID</th>
                    <th class="w-56 px-3 py-2 border-b">Название</th>
                    <th class="w-44 px-3 py-2 border-b">Телефон</th>
                    <th class="w-64 px-3 py-2 border-b">Email</th>
                    <th class="w-28 px-3 py-2 border-b">Владелец</th>
                    <th class="px-3 py-2 border-b">Описание</th>
                    <th class="w-40 px-3 py-2 border-b">Создано</th>
                    <th class="w-52 px-3 py-2 border-b">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($organizations as $org)
                    <tr class="hover:bg-gray-50 align-top">
                        <td class="px-3 py-3 border-b whitespace-nowrap">#{{ $org->id }}</td>

                        <td class="px-3 py-3 border-b">
                            <div class="truncate" title="{{ $org->name }}">{{ $org->name ?? '—' }}</div>
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="break-words" title="{{ $org->phone }}">{{ $org->phone ?? '—' }}</div>
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="break-all" title="{{ $org->email }}">{{ $org->email ?? '—' }}</div>
                        </td>

                        <td class="px-3 py-3 border-b whitespace-nowrap">{{ $org->owner_id ?? '—' }}</td>

                        <td class="px-3 py-3 border-b">
                            <div class="max-w-[42ch] break-words text-gray-800" title="{{ $org->description }}">
                                {{ $org->description ?? '—' }}
                            </div>
                        </td>

                        <td class="px-3 py-3 border-b whitespace-nowrap">
                            {{ $org->created_at?->format('d.m.Y H:i') ?? '—' }}
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="flex flex-wrap items-center gap-2">
                                @if (Route::has('organizations.show'))
                                    <a href="{{ route('organizations.show', $org) }}"
                                       class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                        Просмотр
                                    </a>
                                @endif
                                @if (Route::has('organizations.edit'))
                                    <a href="{{ route('organizations.edit', $org) }}"
                                       class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                        Редактировать
                                    </a>
                                @endif
                                @if (Route::has('organizations.destroy'))
                                    <form action="{{ route('organizations.destroy', $org) }}" method="POST"
                                          onsubmit="return confirm('Удалить компанию?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
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
