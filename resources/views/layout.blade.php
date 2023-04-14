<!DOCTYPE html>
<html>
<head>
    <title>Mankala</title>
    <link rel="stylesheet" href="{{ cdn_link('bootstrap5.css') }}">
    @yield('styles')
</head>
<body>
@include('menu')
<div class="mx-auto ms-lg-80">
    Rendered at: {{ now() }}
    @yield('content')
</div>

<script src="{{ cdn_link('socket.io.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
<script src="{{ cdn_link('live.js') }}#js,css"></script>
</body>
</html>
