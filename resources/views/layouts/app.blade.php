<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'HostelTrack')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  @if (session('status'))
    <div class="alert-success">{{ session('status') }}</div>
  @endif

  @yield('content')
</body>
</html>
