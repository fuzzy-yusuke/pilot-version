@extends('layouts.dashboardsystem')

@section('content')
<div id="app">

    <body>
        @csrf
        <dashboardsystem-component></dashboardsystem-component>
    </body>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
@endsection