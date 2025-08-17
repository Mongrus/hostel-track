@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить комнату</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="number" class="form-label">Номер комнаты</label>
            <input type="number" name="number" id="number" 
                   class="form-control" value="{{ old('number') }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Тип комнаты</label>
            <select name="type" id="type" class="form-control" required>
                @foreach(\App\Enums\RoomType::cases() as $type)
                    <option value="{{ $type->value }}" 
                        {{ old('type') == $type->value ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" 
                      class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection
