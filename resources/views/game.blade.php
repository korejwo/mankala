@extends('layout')

@section('content')
    <button type="button" class="btn btn-primary" onclick="restartSocketServer()">Restart socket server</button>
    <div class="container">
        <canvas id="game" width="900" height="300"></canvas>
    </div>
@endsection

@section('styles')
    <style>
        #game {
            border: 2px black solid;
            margin: auto;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ cdn_link('fabric.min.js') }}"></script>
    <script src="{{ cdn_link('pako.js') }}"></script>
    <script src="{{ asset('js/zlib.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/game.js') }}"></script>
@endsection
