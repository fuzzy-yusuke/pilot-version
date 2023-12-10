@extends('layouts.app')

@section('title', 'ダッシュボード')

@section('content')

@csrf

<body>
    <div id="app">
        <dashboard-component></dashboard-component>
    </div>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js')}}"></script>
</body>

@endsection