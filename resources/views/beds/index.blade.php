@extends('layouts.app')

@section('title', "Койки в комнате №{$room->number}")

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Койки в комнате №{{ $room->number }}</h1>

        <div class="flex items-center gap-4">
            <a href="{{ route('rooms.show', $room->id) }}" class="text-blue-600 hover:underline">
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
                </tr>
            </thead>
            <tbody>
                @foreach($beds as $bed)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $bed->label }}</td>
                        <td class="px-4 py-2 border-b">{{ $bed->description ?? '—' }}</td>
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
