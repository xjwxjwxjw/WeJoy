<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('js_css')
    <title>@yield('title')</title>

</head>
<body>
  
  <div class="box">
    @section('top')
    @show
  </div>
  <div class="col-md-6 col-md-offset-3">
    @yield('slideTop')
    @yield('slideLeft')
    @yield('slideRight')
  </div>
  @section('footer')
  @show
</body>
</html>
