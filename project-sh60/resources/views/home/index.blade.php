@extends('master')
@section('my-css')
    <link rel="stylesheet" href="/css/style.css">
@endsection
@section('content')
    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>
                欢迎来到我的社区
                <a class="btn btn-lg btn-primary pull-right" href="../../components/#navbar" role="button">发表新贴</a>
            </h2>
        </div>
    </div>
@endsection