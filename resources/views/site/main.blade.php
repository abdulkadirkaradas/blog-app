@extends("layouts.admin")
@section("content")

<div class="container">
    <div class="title">Gülşah Karadaş</div>
</div>

@endsection

@section('scripts')
@parent

<script>
</script>

@endsection

@section('styles')
@parent

<style>
    html, body {
        width: 100%;
        height: 100%;
    }

    .container {
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .container .title {
        text-align: center;
        font-size: 75px;
    }
</style>

@endsection
