@extends('layouts.app')

@section('title', 'Список комнат')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">Список комнат</h1>

    @if (session('success'))
        <div class="mb-6 rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('rooms.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Добавить комнату
        </a>
    </div>

    @if($rooms->isEmpty())
        <p class="text-gray-500">Комнат пока нет.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">№</th>
                    <th class="px-4 py-2 border-b text-left">Тип</th>
                    <th class="px-4 py-2 border-b text-left">Описание</th>
                    <th class="px-4 py-2 border-b text-right">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('rooms.show', $room->id) }}" 
                               class="text-blue-600 hover:underline">
                                {{ $room->number }}
                            </a>
                        </td>
                        <td class="px-4 py-2 border-b">{{ $room->type }}</td>
                        <td class="px-4 py-2 border-b">{{ $room->description ?? '—' }}</td>
                        <td class="px-4 py-2 border-b text-right space-x-2">
                            <a href="{{ route('rooms.edit', $room->id) }}" 
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Редактировать
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" 
                                  method="POST" 
                                  class="inline-block"
                                  onsubmit="return confirm('Удалить эту комнату?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
