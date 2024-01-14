<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CarApp</title>
    </head>
    <body>
        @if (Auth::check())
            <script>window.location = "{{ route('dashboard.root') }}";</script>
        @else
            <script>window.location = "{{ route('auth.login') }}";</script>
        @endif
    </body>
</html>
