<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/admin/assets/i/favicon.png">
    <title>@yield('title')</title>
</head>
<body>
    @section('top')
    @show

    <div>
        @yield('sidebar')
    </div>
    <div>
        @yield('content')
    </div>
</body>
</html>
