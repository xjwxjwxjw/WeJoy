@extends('/home/layouts/app')
@section('title','Wejoy')
@section('js_css')
    @include('/home/public/js_css')
@endsection
@section('top')
    @include('/home/public/top')
@endsection
@section('content')
    <div>
        <h2>激活成功</h2>
        <h4><a href="{{url('home/index')}}">点我跳转至登陆页面</a></h4>
    </div>
@endsection
@section('footer')
    @include('home/public/footer')
@endsection