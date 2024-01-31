<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>システム管理者用ダッシュボード</title>

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ mix('css/header.css') }}">
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <header>
                <h2>システム管理者用ダッシュボード</h2>
                <p>ようこそ、{{ $sys_user_name->sys_user_name }}さん</p>
                <form id="logout-button" method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-secondary logout-btn" type="submit">ログアウト</button>
                </form>
            </header>
        </div>


        <div id="dashboard">
            @yield('content')
        </div>


</body>
</div>

</html>