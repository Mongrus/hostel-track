@extends('layouts.app')

@section('title', 'Добавить жильца')

@section('content')
<div class="container mx-auto mt-8 space-y-6">
    @if (session('success'))
        <div class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-md bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
            <div class="font-semibold mb-1">Проверьте поля формы:</div>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Добавить жильца</h1>
        <a href="{{ route('residents.index') }}" class="px-3 py-2 border rounded hover:bg-gray-50 text-sm">
            ← К списку жильцов
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <form method="POST" action="{{ route('residents.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm text-gray-600 mb-1">Фамилия *</label>
                <input name="surname" value="{{ old('surname') }}" class="border rounded px-3 py-2 w-full" required>
                @error('surname')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Имя *</label>
                <input name="name" value="{{ old('name') }}" class="border rounded px-3 py-2 w-full" required>
                @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Телефон *</label>
                <input name="phone" value="{{ old('phone') }}" class="border rounded px-3 py-2 w-full" required>
                @error('phone')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Режим организации: none | existing | new --}}
            <div class="pt-2 border-t">
                <label class="block text-sm text-gray-600 mb-2">Организация</label>

                <div class="flex flex-wrap items-center gap-6 mb-3">
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="organization_mode" value="none"
                               {{ old('organization_mode','none')==='none' ? 'checked' : '' }}>
                        <span>Не состоит</span>
                    </label>

                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="organization_mode" value="existing"
                               {{ old('organization_mode')==='existing' ? 'checked' : '' }}>
                        <span>Выбрать из списка</span>
                    </label>

                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="organization_mode" value="new"
                               {{ old('organization_mode')==='new' ? 'checked' : '' }}>
                        <span>Создать новую</span>
                    </label>
                </div>

                {{-- existing --}}
                <div id="org-existing" class="mb-3" style="display:none">
                    <select name="organization_id" class="border rounded px-3 py-2 w-full">
                        <option value="">— выберите организацию —</option>
                        @foreach(($organizations ?? []) as $org)
                            <option value="{{ $org->id }}" @selected(old('organization_id')==$org->id)>
                                {{ $org->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('organization_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                {{-- new --}}
                <div id="org-new" class="mb-3" style="display:none">
                    <input name="new_organization_name"
                           placeholder="Название новой организации"
                           value="{{ old('new_organization_name') }}"
                           class="border rounded px-3 py-2 w-full">
                    @error('new_organization_name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Сохранить
                </button>
                <a href="{{ route('residents.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</div>

<script>
(function(){
  const radios = document.querySelectorAll('input[name="organization_mode"]');
  const ex = document.getElementById('org-existing');
  const nw = document.getElementById('org-new');
  function sync(){
    const val = document.querySelector('input[name="organization_mode"]:checked')?.value;
    ex.style.display = (val === 'existing') ? '' : 'none';
    nw.style.display = (val === 'new') ? '' : 'none';
  }
  radios.forEach(r => r.addEventListener('change', sync));
  sync();
})();
</script>
@endsection
