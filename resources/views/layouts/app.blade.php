<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'nonce-{{$hash_primary}}'
    'nonce-{{$hash_secondary}}' https://ajax.googleapis.com  {{ config('app.url') }} ;">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <!-- Styles -->
    <link href="{{ asset(mix('css/vendor.css')) }}" rel="stylesheet">
    @yield('css_secondary')
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="display: none;">
        @if (\Route::current() != null)
            @if(\Route::current()->getName() != 'viewLogin' && \Route::current()->getName() != 'viewLoginMain')
                @include('partial.menu')
            @else
                @include('partial.header_main')
            @endif
        @else
            @include('partial.header_main')
        @endif
        @section('content')
            @include('partial.session_ms')
        @show
    </div>
    <!-- Scripts Mains-->
    <script src="{{ asset('js/DocReady.js') }}"></script>
    <script type="text/javascript" nonce="{{ $hash_primary }}">
        document.getElementById("app").style.display = 'block';
        var link_out  = document.getElementById("logout");
        if (link_out != null) {
            link_out.onclick = logout;
            function logout(event){
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        }
    </script>
    <!-- Scripts -->
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset(mix('js/popper.min.js')) }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/vendor.js')) }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>
    @yield('js_secondary')
</body>
</html>
