@extends('layouts.app')

@section('title', 'Бронирования')

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    @if (session('success'))
        <div class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    @php
        $isPaginator = $bookings instanceof \Illuminate\Contracts\Pagination\Paginator;
        $total = $isPaginator ? $bookings->total() : $bookings->count();

        $fmt = function ($v) {
            if ($v instanceof \DateTimeInterface) return $v->format('d.m.Y');
            if (is_string($v) && $v !== '') {
                try { return \Illuminate\Support\Carbon::parse($v)->format('d.m.Y'); }
                catch (\Throwable) { return $v; }
            }
            return '—';
        };
    @endphp

    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold">Бронирования</h1>
            <p class="text-gray-500 text-sm">Всего: {{ $total }}</p>
        </div>

        @if (Route::has('bookings.create'))
            <a href="{{ route('bookings.create') }}"
               class="shrink-0 px-3 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                Новое бронирование
            </a>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow">
        <table class="min-w-full table-fixed text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="w-14  px-3 py-2 border-b">ID</th>
                    <th class="w-40  px-3 py-2 border-b">Комната</th>
                    <th class="w-36  px-3 py-2 border-b">Койка</th>
                    <th class="w-56  px-3 py-2 border-b">Жилец</th>
                    <th class="w-24  px-3 py-2 border-b">Уровень</th>
                    <th class="w-32  px-3 py-2 border-b">Статус</th>
                    <th class="w-56  px-3 py-2 border-b">Период</th>
                    <th class="w-48  px-3 py-2 border-b">Создал</th>
                    <th class="px-3 py-2 border-b">Комментарий</th>
                    <th class="w-52  px-3 py-2 border-b">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $b)
                    @php
                        $statusValue = $b->status instanceof \BackedEnum ? $b->status->value : (string) $b->status;
                        $levelValue  = $b->booking_level instanceof \BackedEnum ? $b->booking_level->value : (string) $b->booking_level;

                        $statusClass = match ($statusValue) {
                            'booked'   => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                            'daily'    => 'bg-blue-100 text-blue-800 border-blue-300',
                            'longterm' => 'bg-green-100 text-green-800 border-green-300',
                            default    => 'bg-gray-100 text-gray-800 border-gray-300',
                        };
                    @endphp

                    <tr class="hover:bg-gray-50 align-top">
                        <td class="px-3 py-3 border-b whitespace-nowrap">#{{ $b->id }}</td>

                        <td class="px-3 py-3 border-b">
                            <div class="truncate" title="{{ $b->room?->name ?? ('ID '.$b->room_id) }}">
                                {{ $b->room?->name ?? ('ID '.$b->room_id) }}
                            </div>
                        </td>

                        <td class="px-3 py-3 border-b whitespace-nowrap">
                            ID {{ $b->bed?->id ?? $b->bed_id ?? '—' }}
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="truncate" title="{{ trim(($b->resident->surname ?? '').' '.($b->resident->name ?? '')) }}">
                                {{ trim(($b->resident->surname ?? '—').' '.($b->resident->name ?? '')) }}
                            </div>
                        </td>

                        <td class="px-3 py-3 border-b whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded border text-xs uppercase">
                                {{ $levelValue ?: '—' }}
                            </span>
                        </td>

                        <td class="px-3 py-3 border-b whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded border text-xs uppercase {{ $statusClass }}">
                                {{ $statusValue ?: '—' }}
                            </span>
                        </td>

                        <td class="px-3 py-3 border-b whitespace-nowrap">
                            {{ $fmt($b->start_date) }} &nbsp;→&nbsp; {{ $fmt($b->end_date) }}
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="truncate" title="{{ $b->user?->name ?? ('ID '.$b->user_id) }}">
                                {{ $b->user?->name ?? ('ID '.$b->user_id) }}
                            </div>
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="max-w-[42ch] break-words text-gray-800" title="{{ $b->comment }}">
                                {{ $b->comment ?? '—' }}
                            </div>
                        </td>

                        <td class="px-3 py-3 border-b">
                            <div class="flex flex-wrap items-center gap-2">
                                @if (Route::has('bookings.show'))
                                    <a href="{{ route('bookings.show', $b) }}"
                                       class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                        Просмотр
                                    </a>
                                @endif
                                @if (Route::has('bookings.edit'))
                                    <a href="{{ route('bookings.edit', $b) }}"
                                       class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">
                                        Правка
                                    </a>
                                @endif
                                @if (Route::has('bookings.destroy'))
                                    <form action="{{ route('bookings.destroy', $b) }}" method="POST"
                                          onsubmit="return confirm('Удалить бронирование?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                            Удалить
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-6 text-center text-gray-500" colspan="10">
                            Бронирований не найдено.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($isPaginator)
        <div class="mt-4">
            {{ $bookings->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
