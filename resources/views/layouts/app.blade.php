<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'HostelTrack')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

  @include('layouts.navbar')

  @if (session('status'))
    <div class="bg-green-100 text-green-800 p-4">
      {{ session('status') }}
    </div>
  @endif

  <main class="container mx-auto mt-6">
      @yield('content')
  </main>

</body>
</html>
