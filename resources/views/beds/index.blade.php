@extends('layouts.app')

@section('title', "Койки в комнате №{$room->number}")

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Койки в комнате №{{ $room->number }}</h1>

        <div class="flex items-center gap-4">
            <a href="{{ route('rooms.show', $room) }}" class="text-blue-600 hover:underline">
                ← Назад к комнате
            </a>
            <a href="{{ route('rooms.index') }}" class="text-blue-600 hover:underline">
                Список комнат
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    @php $isPaginator = $beds instanceof \Illuminate\Contracts\Pagination\Paginator; @endphp

    @if(($isPaginator && $beds->total() === 0) || (!$isPaginator && $beds->isEmpty()))
        <p class="text-gray-500">В этой комнате пока нет коек.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Койка</th>
                    <th class="px-4 py-2 border-b text-left">Описание</th>
                    <th class="px-4 py-2 border-b text-left">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beds as $bed)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $bed->label }}</td>
                        <td class="px-4 py-2 border-b">{{ $bed->description ?? '—' }}</td>
                        <td class="px-4 py-2 border-b flex gap-2">
                            {{-- Просмотр --}}
                            <a href="{{ route('beds.show', [$room, $bed]) }}"
                               class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                Просмотр
                            </a>

                            {{-- Редактировать --}}
                            <a href="{{ route('beds.edit', [$room, $bed]) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Редактировать
                            </a>

                            {{-- Удалить --}}
                            <form action="{{ route('beds.destroy', [$room, $bed]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Удалить эту койку?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($isPaginator)
            <div class="mt-4">
                {{ $beds->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
