@extends('/home/layouts/app')
    @section('title','Wejoy')
    @section('js_css')
        @include('/home/public/js_css')
        <style>
            #box-content{
                float:left;
                position: relative;
                background-color:#fff;
                max-width: 602px;
                margin-right: 10px;
                margin-bottom: 10px;
                text-align: center;
            }
        </style>
    @endsection
    @section('top')
        @include('/home/public/top')
    @endsection
    @section('slideLeft')

    @endsection
    @section('content')
        <div style='width:602px;' class="box-content clearfix" id="box-content">
            <h1 style="margin:40px">关于微距</h1>
            <div style="margin:20px 50px;" id="information">
                {{$result->infor}}
            </div>
        </div>
        <div style='width:602px;' class="box-content clearfix" id="box-content">
            <h1 style="margin:40px">产品服务</h1>
            <div style="margin:20px 50px;" id="information">
                {{$result->service}}
            </div>
        </div>
        <div style='width:602px;' class="box-content clearfix" id="box-content">
            <h1 style="margin:40px">创新优势</h1>
            <div style="margin:20px 50px;" id="information">
                {{$result->advantage}}
            </div>
        </div>
        <div style='width:602px;' class="box-content clearfix" id="box-content">
            <h1 style="margin:40px">联系</h1>
            <div style="margin:20px 50px;" id="information">
                {{$result->contact}}
            </div>
        </div>
    @endsection
    @section('slideRight')

    @endsection
    @section('footer')

    @endsection

{{--@endsection--}}
