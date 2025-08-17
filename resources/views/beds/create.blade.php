@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить койки в комнату {{ $room->number }}</h1>

    <form method="POST" action="{{ route('beds.store', $room->id) }}">
        @csrf

        <div id="beds-container">
            <div class="bed-input mb-4 border p-3 rounded relative">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="m-0">Номер койки</label>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-bed" title="Убрать койку">×</button>
                </div>
                <input type="text" name="beds[]" class="form-control mb-2" required>

                <label>Описание (необязательно)</label>
                <input type="text" name="descriptions[]" class="form-control">
            </div>
        </div>

        <button type="button" id="add-bed" class="btn btn-secondary mb-3">Добавить койку +</button>
        <br>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>

<script>
const container = document.getElementById('beds-container');
document.getElementById('add-bed').addEventListener('click', function () {
    const div = document.createElement('div');
    div.className = 'bed-input mb-4 border p-3 rounded';
    div.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="m-0">Номер койки</label>
            <button type="button" class="btn btn-sm btn-outline-danger remove-bed" title="Убрать койку">×</button>
        </div>
        <input type="text" name="beds[]" class="form-control mb-2" required>
        <label>Описание (необязательно)</label>
        <input type="text" name="descriptions[]" class="form-control">
    `;
    container.appendChild(div);
});

container.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-bed')) {
        const blocks = container.querySelectorAll('.bed-input');
        if (blocks.length <= 1) {
            alert('Нужна как минимум одна койка.');
            return;
        }
        e.target.closest('.bed-input').remove();
    }
});
</script>
@endsection
