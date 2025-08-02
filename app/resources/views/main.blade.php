<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('name', 'Laravel Message')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col w-screen h-screen bg-red-200">
    <x-navigation-bar/>

    <div class="flex flex-col w-3xl m-x-auto">
        @yield('main')
    </div>
</body>
</html>