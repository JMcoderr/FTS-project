<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>FTS Project</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if(request()->path() == '' || request()->path() == '/')
        <link rel="stylesheet" href="/css/welcome.css">
    @endif
</head>
<body>
    @yield('content')
</body>
</html>
