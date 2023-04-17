@extends('layout')

@section('content')
    <button type="button" class="btn btn-primary" onclick="restartSocketServer()">Restart socket server</button>
    <button type="button" class="btn btn-primary" onclick="window.location = '{{ route('reRock', ['id' => $id]) }}';">reRock</button>
    <div class="container">
        <canvas id="game" width="900" height="300"></canvas>
    </div>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        #game {
            border: 2px black solid;
            margin: auto;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">
        const items = JSON.parse('{!! $data !!}');
        const apiUpdate = '{{ route('api.update', ['id' => $id]) }}';
    </script>
    <script src="{{ cdn_link('fabric.min.js') }}"></script>
    <script src="{{ cdn_link('pako.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/zlib.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/game.js') }}"></script>
@endsection
