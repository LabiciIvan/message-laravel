<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>
<body>
    <x-navigation-bar/>
    Welcome to Message-App, @if (Auth::check()) {{ Auth::user()->name }}  @endif
</body>
</html>