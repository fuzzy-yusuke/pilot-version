@extends('layouts.app')

@section('title', 'テナントマスタ管理画面')

@section('content')
<div id="app">

    <body>
        @csrf
        <tenant-component :tenants="{{ $tenants }}"></tenant-component>
    </body>
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection