<!DOCTYPE html>
<html>
<head>
    <title>Mankala</title>
    <link rel="stylesheet" href="{{ cdn_link('bootstrap5.css') }}">
    <script src="{{ cdn_link('live.js') }}"></script>
    <script src="{{ cdn_link('socket.io.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</head>
<body>
<div>
    <section>
        @include('menu')
        <div class="mx-auto ms-lg-80">
            @yield('content')
        </div>
    </section>
</div>

</body>
</html>
