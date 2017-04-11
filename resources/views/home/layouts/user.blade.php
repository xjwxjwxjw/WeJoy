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
  <div class="row" style="margin:0 auto;width:950px;">
    <div class="col-md-8col-md-offset-2 clearfix">
      @yield('slideTop')
      @yield('slideLeft')
      @yield('slideRight')
    </div>
  </div>
  @section('footer')
  @show
</body>
</html>
