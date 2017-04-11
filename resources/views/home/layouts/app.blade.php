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
  <div class="bodybg">
    <div class="box">
      @section('top')
      @show
    </div>
    <div class="clearfix box_main bgcolor">
      @yield('slideLeft')
      @yield('content')
      @yield('slideRight')
    </div>
  </div>
</script>
</body>
</html>
