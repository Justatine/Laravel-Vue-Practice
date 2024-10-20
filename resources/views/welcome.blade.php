<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Laravel App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>
<body class="h-full flex flex-col">

    <div id="header"></div>

    <div class="container flex-grow p-8">
        <div id="app"></div>
    </div>

    <div id="footer"></div>

    @vite('resources/js/app.js')
    <script src="js/auth/auth.js"></script>
</body>
</html>