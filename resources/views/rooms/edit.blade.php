@extends('layouts.app')

@section('content')
    <h1>Редактировать комнату</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="number">Номер комнаты:</label>
            <input type="number" name="number" id="number"
                   value="{{ old('number', $room->number) }}" required>
        </div>

        <div>
            <label for="type">Тип:</label>
            <select name="type" id="type" required>
                @foreach(\App\Enums\RoomType::cases() as $type)
                    <option value="{{ $type->value }}"
                        {{ old('type', $room->type->value) === $type->value ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description">{{ old('description', $room->description) }}</textarea>
        </div>

        <button type="submit">Сохранить изменения</button>
        <a href="{{ route('rooms.index') }}">Отмена</a>
    </form>
@endsection
