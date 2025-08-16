<nav class="bg-gray-800 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="font-bold text-lg">HostelTrack</a>

        <ul class="flex space-x-6">
            <li>
                <a href="{{ route('rooms.index') }}" 
                   class="hover:text-gray-300">Комнаты</a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="hover:text-gray-300">Дашборд</a>
            </li>
        </ul>

        <div>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-gray-300">
                        Выйти
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="hover:text-gray-300 mr-4">Войти</a>
                <a href="{{ route('register.form') }}" class="hover:text-gray-300">Регистрация</a>
            @endguest
        </div>
    </div>
</nav>
