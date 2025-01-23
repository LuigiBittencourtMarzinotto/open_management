<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('public/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gerenciador</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body data-bs-theme="light">
    <div id="app">
        <main> 
            <nav-bar-component name-user='{{ session('nameUser') }}' route-logout='{{ route('login.logout') }}' route-user={{ route('user.view') }} route-login-user='{{ route('show-user', session('nameID')) }}' tipo-user={{ session('tipoUser') }} route-home={{ route('dashboard.index') }}></nav-bar-component>
            <div class="d-flex justify-content-center">
                @yield('content')

            </div>
        </main>
    </div>
</body>

</html>
