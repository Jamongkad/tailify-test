<html>
    <head>
        <title>Tailify Test</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> 
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body class="nav-md">
        <div class="container body" id="app">
            @yield('content')
        </div> 
    </body>
    
    <div style="height:50"></div>
        <footer class="text-center">
            Lovingly built on top of Laravel 5.3 and Vue.js 2.0.1
        </footer>
    <div style="height:25px"></div>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
