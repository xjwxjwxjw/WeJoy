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
        <h2>注册成功，请查看邮件，激活后即可登录</h2>
        <h4>已经激活？<a href="{{url('home/index')}}">点我跳转至登陆页面</a></h4>
    </div>
@endsection
@section('footer')
    @include('home/public/footer')
@endsection