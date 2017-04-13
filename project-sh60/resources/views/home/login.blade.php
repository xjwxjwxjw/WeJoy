@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>欢迎登录</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/singin" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">邮箱</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密码</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="code" placeholder="请输入验证码"/>
                    {!! captcha_img()!!}
                </div>
                <button type="submit" class="btn btn-default btn-block btn-success">点击登录</button>
            </form>
        </div>
    </div>
</div>
@endsection