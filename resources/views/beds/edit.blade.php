@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-1">Проверьте введённые данные:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Комнаты</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rooms.show', $room) }}">Комната №{{ $room->number ?? $room->id }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактирование койки</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Редактировать койку №{{ $bed->label ?? $bed->id }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('beds.show', [$room, $bed]) }}" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('beds.update', [$room, $bed]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Комната</label>
                    <input type="text" class="form-control" value="№{{ $room->number ?? $room->id }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="label" class="form-label">Номер койки *</label>
                    <input
                        id="label"
                        name="label" 
                        type="text"
                        class="form-control @error('label') is-invalid @enderror"
                        value="{{ old('label', $bed->label) }}"
                        required
                    >
                    @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="3"
                    >{{ old('description', $bed->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{ route('beds.show', [$room, $bed]) }}" class="btn btn-outline-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
