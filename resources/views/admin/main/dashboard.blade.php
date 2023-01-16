@extends("layouts.admin")
@section("content")

<div class="dashboard-container" id="cp-app">
    <cp-app></cp-app>
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
        background-color: #F8FAFC;
    }

    .dashboard-container {
        width: 100%;
        height: 100%;
    }
</style>

@endsection
