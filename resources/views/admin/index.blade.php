@extends('/admin/layouts/app')
@section('js_css')
	@include('/admin/public/js_css')
	@include('/admin/public/js_css/new_js_css')
@endsection
@section('title','page Title')
@section('top')
    @include('/admin/public/top')
@endsection
@section('sidebar')
    @include('/admin/public/sidebar')
@endsection
@section('content')
    @include('/admin/public/content')
@endsection
