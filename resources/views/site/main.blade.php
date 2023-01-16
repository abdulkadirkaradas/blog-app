@extends("layouts.site")
@section("content")

<div class="page-container" id="site-app">
    <site-app></site-app>
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
