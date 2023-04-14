@extends('layout')

@section('content')
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
    <script src="{{ asset('js/game.js') }}"></script>
@endsection
