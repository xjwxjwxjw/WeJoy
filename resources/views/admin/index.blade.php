<?php

  empty($content)?'/admin/public/content':$content;

 ?>
@extends('/admin/layouts/app')
@section('js_css')
	@include('/admin/public/js_css')
@endsection
@section('title','page Title')
@section('top')
    @include('/admin/public/top')
@endsection
@section('sidebar')
    @include('/admin/public/sidebar')
@endsection
@section('content')
    @include($content)
@endsection
