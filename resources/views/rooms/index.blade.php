@extends('layouts.app')

@section('title', 'Список комнат')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">Список комнат</h1>

    @if($rooms->isEmpty())
        <p class="text-gray-500">Комнат пока нет.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">№</th>
                    <th class="px-4 py-2 border-b">Тип</th>
                    <th class="px-4 py-2 border-b">Описание</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $room->number }}</td>
                        <td class="px-4 py-2 border-b">{{ $room->type }}</td>
                        <td class="px-4 py-2 border-b">{{ $room->description ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection