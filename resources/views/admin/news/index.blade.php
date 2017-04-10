@extends('/admin/layouts/app')
@section('title','page Title')
@section('js_css')
	@include('/admin/public/js_css')
@endsection
@section('top')
    @include('/admin/public/top')
@endsection
@section('sidebar')
    @include('/admin/public/sidebar')
@endsection
@section('content')
    @include('/admin/news/content')
@endsection
