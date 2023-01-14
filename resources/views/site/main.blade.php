@extends("layouts.admin")
@section("content")

<div class="page-container" id="main-app">
    <main-app></main-app>
</div>

@endsection

@section('scripts')
@parent

    @vite('resources/js/app.js')

@endsection

@section('styles')
@parent

<style>
    html, body {
        width: 100%;
        height: 100%;
    }

    .page-container {
        width: 100%;
        height: 100%;
    }
</style>

@endsection
