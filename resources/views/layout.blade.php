<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Matkul Management System</title>
        <link href="{{ asset('assets/style.css') }}" rel="stylesheet"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="font-sans">
        @yield('content')
    </body>
</html>
