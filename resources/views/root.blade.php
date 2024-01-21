<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CarApp</title>
    </head>
    <body>
        <script>window.location = "{{ route('dashboard') }}";</script>
    </body>
</html>
