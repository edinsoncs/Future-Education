<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="stylesheet" href="{{ asset('/landing/vendors/mdi/css/materialdesignicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/landing/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/landing/css/plugins/plugins.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/landing/css/style.min.css')}}">


</head>
<body>
    @yield('content')
    

    <script src="{{ asset('/landing/js/vendor/vendor.min.js')}}"></script>
    <script src="{{ asset('/landing/js/plugins/plugins.min.js')}}"></script>
    <script src="{{ asset('/landing/js/main.js')}}"></script>

</body>
</html>
