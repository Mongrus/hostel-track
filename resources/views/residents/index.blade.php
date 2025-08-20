@extends('layouts.app')

@section('title', 'Жильцы')

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    @if (session('success'))
        <div class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    @php
        $isPaginator = $residents instanceof \Illuminate\Contracts\Pagination\Paginator;
        $total = $isPaginator ? $residents->total() : $residents->count();
    @endphp

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Жильцы</h1>
            <p class="text-gray-500 text-sm">Всего: {{ $total }}</p>
        </div>

        @if (Route::has('resident.create'))
            <a href="{{ route('resident.create') }}"
               class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                Добавить жильца
            </a>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-left text-sm">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">ФИО</th>
                    <th class="px-4 py-2 border-b">Телефон</th>
                    <th class="px-4 py-2 border-b">ID организации</th>
                    <th class="px-4 py-2 border-b">Создан</th>
                    <th class="px-4 py-2 border-b">Обновлён</th>
                    <th class="px-4 py-2 border-b">Действия</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse ($residents as $resident)
                    @php
                        $fullName = trim(($resident->surname ?? '').' '.($resident->name ?? ''));
                        if ($fullName === '') $fullName = '—';
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">{{ $resident->id }}</td>
                        <td class="px-4 py-3 border-b">
                            <div class="font-medium text-gray-900">{{ $fullName }}</div>
                        </td>
                        <td class="px-4 py-3 border-b">{{ $resident->phone ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">{{ $resident->organization_id ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">{{ $resident->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">{{ $resident->updated_at?->format('d.m.Y H:i') ?? '—' }}</td>
                        <td class="px-4 py-3 border-b">
                            <div class="flex items-center gap-2">
                                @if (Route::has('residents.show'))
                                    <a href="{{ route('residents.show', $resident) }}"
                                       class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                        Просмотр
                                    </a>
                                @endif
                                @if (Route::has('residents.edit'))
                                    <a href="{{ route('residents.edit', $resident) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                        Редактировать
                                    </a>
                                @endif
                                @if (Route::has('residents.destroy'))
                                    <form action="{{ route('residents.destroy', $resident) }}" method="POST"
                                          onsubmit="return confirm('Удалить жильца?');">
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
                        <td class="px-4 py-6 text-center text-gray-500" colspan="7">
                            Жильцы не найдены.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($isPaginator)
        <div class="mt-4">
            {{ $residents->links() }}
        </div>
    @endif
</div>
@endsection
