@if(!Cookie::has('UserId'))
    <script>window.location.href = '/home/index'</script>
    {{--用中间件判断--}}
@else
    @extends('/home/layouts/user')
    @section('title','Wejoy')
@section('js_css')
    <link rel="icon" type="image/png" href={{url("/admin/assets/i/favicon.png")}}>
    <link rel="stylesheet" href={{url("/css/app.css")}}>
    <link rel="stylesheet" href={{url("/css/bootstrap.css")}}>
    <link  rel="stylesheet" href={{url("/home/css/main.css")}} >
    <link rel="stylesheet" type="text/css" href={{url("/home/css/sinaFaceAndEffec.css")}}>
    <link rel="stylesheet" type="text/css" href={{url("/home/css/wejoyIndex.css")}}>
    <link rel="stylesheet" href={{url("/home/css/footer.css")}} >
    <script src={{url("/js/app.js")}}></script>
    <script src={{url("home/js/jquery-1.8.3.min.js")}}></script>
    <script src={{url("home/js/jQueryColor.js")}}></script>
    <!-- toastr提示插件 -->
    <link rel="stylesheet" href={{url("admin/css/toastr.min.css")}}>
    <script src={{url("/admin/js/toastr.min.js")}}></script>
    <!--这个插件只是为了扩展jquery的animate函数动态效果可有可无-->
    <script src={{url("home/js/jQeasing.js")}}></script>
    <script src={{url("home/js/sinaFaceAndEffec.js")}}></script>
    <link rel="icon" type="image/png" href={{url("/admin/assets/i/favicon.png")}}>
    <link rel="stylesheet" href={{url("css/app.css")}}>
    <link rel="stylesheet" href={{url("css/bootstrap.css")}}>
    <link  rel="stylesheet" href={{url("home/css/main.css")}} >
    <link rel="stylesheet" type="text/css" href={{url("home/css/sinaFaceAndEffec.css")}}>
    <link rel="stylesheet" type="text/css" href={{url("home/css/wejoyIndex.css")}}>
    <link rel="stylesheet" href="{{url('/home/css/index.css')}}">
    <link rel="stylesheet" href="{{url('/home/css/user/photo.css')}}">
    <script src={{url('/home/js/login.js')}}></script>
    <script src={{url('/home/js/album.js')}}></script>
    {{--相册图片轮播图 开始--}}
    <link rel="stylesheet" href="{{url('/home/css/user/imageflow.css')}}">
    <script src={{url('/home/js/imageflow.js')}}></script>
    <script src={{url('/home/js/jquery.js')}}></script>
    {{--相册图片轮播图 结束--}}
    <style type="text/css">
        body{background-image:url( {{ url('home/image/body_bg.jpg') }} );}
    </style>
@endsection
@section('top')
    @include('/home/public/top')
@endsection
@section('slideTop')
    <?php
    $user = DB::select('select * from homeuser where id='.Cookie::get('UserId'))[0];
    $userinfo = DB::table('homeuserinfo')->where('uid',Cookie::get('UserId'))->get()[0];
    ?>
    <div class="col-md-12">
        <div id="Pl_Official_Headerv6__1" class="text-center">
            <div class="PCD_header">
                <div class="pf_wrap" style="background-image:url({{url('/home/bg.jpg')}});background-size:100% 100%;">
                    {{--上面url为背景图片--}}
                    <div class="shadow  S_shadow">
                        <div class="pf_photo">
                            <p class="photo_wrap">
                                <a href="javascript:void(0);"title="更换头像" onclick="editIcon()">
                                    <img src='<?= empty($userinfo->icon)?url('/home/image/default.jpg'):url($userinfo->icon) ?>' alt="{{Cookie::get('UserNickname')}}" class="photo" width="100" height="100">{{--头像--}}
                                </a>
                            </p>
                        </div>
                        <div class="pf_username">
                            <h1 class="username">{{Cookie::get('UserNickname')}}</h1>
                            <span class="icon_bed">
                                            <a>
                                                <i class="W_icon icon_pf_male" style="background-image:url({{url('/home/icon.png')}});background-position: <?= $userinfo->sex==1?'-100px':($userinfo->sex==2?'-125px':'-350px') ?> -50px;"></i>
                                            </a>
                                        </span>
                        </div>
                        <div class="pf_intro" title="<?= empty($userinfo->signature)?'一句话介绍一下自己吧，让别人更了解你':$userinfo->signature ?>">
                            <?= empty($userinfo->signature)?'一句话介绍一下自己吧，让别人更了解你':$userinfo->signature ?>
                        </div>
                    </div>
                    <div class="upcover">
                        <a href="javascript:void(0);" class="W_btn_b"  style="display: none;">
                            <em class="W_ficon ficon_upload S_ficon"></em>上传封面图
                        </a>
                    </div>
                </div>
            </div>
            <div class="layer_menu_list_b" style="position:absolute; top:332px; left:900px; z-index:999;display: none">
                <div class="list_wrap">
                    <div class="list_content W_f14">
                        <ul class="list_ul">
                            <li class="item"><a href="javascript:void(0);" class="tlink" >悄悄关注</a></li>
                            <li class="item"><a  href="javascript:void(0);" class="tlink">推荐给朋友</a></li>
                        </ul>
                        <ul class="list_ul">
                            <li class="item"><a href="javascript:void(0);" class="tlink">加入黑名单</a></li>
                            <li class="item"><a href="javascript:void(0);" class="tlink">举报他</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="Pl_Official_Nav__2" name="place" >
            <div class="PCD_tab S_bg2">
                <div class="tab_wrap" style="width:60%">
                    <table class="tb_tab" cellpadding="0" cellspacing="0">
                        <tr>
                            <td >
                                <a href="{{url('/home/user/index')}}" class="tab_link">
                                    <span class="S_txt1 t_link">我的主页</span>
                                    <span class="ani_border"></span>
                                </a>
                            </td>
                            <td class="current">
                                <a href="{{url('/home/user/photo')}}" class="tab_link">
                                    <span class="S_txt1 t_link">我的相册</span>
                                    <span class="ani_border"></span>
                                </a>
                            </td>
                            <td>
                                <a href="" class="tab_link">
                                    <span class="S_txt1 t_link">管理中心</span>
                                    <span class="ani_border"></span>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('slideLeft')
@endsection

@section('slideRight')
    <div class="col-md-12">
        <div class="inablumo_btn_box">
            <a href="javascript:void(0)" onclick="addPhotos()">添加照片</a>
            @if(!empty($photoes))
                <a href="{{url('/home/user/photo/my/'.$Aid.'/manage')}}">管理</a>
            @endif
        </div>
    </div>
    <div class="photo_box col-md-12">
        @if(empty($photoes))
            <div class="profile_photo">
                <div class="photo_null_box"><span class="glyphicon glyphicon-remove"></span>暂无图片</div>
            </div>
        @elseif(count($photoes) < 6)
            <div class="profile_photo">
                <div class="photo_full_box photoes_full_box">
                    @foreach($photoes as $k=>$v)
                        <div class="photo_img_div">
                            <div class="photo_img_box">
                                <img src="{{url($v['PhotosUrl'])}}" title="创建日期：{{date('Y年m月d日',$v['CreateTime'])}}">
                            </div>
                            <div class="photo_name_box">{{$v['PhotosName']}}</div>
                            <div class="photo_description_box">{{$v['PhotosDescription']}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="profile_photo" id="LoopDiv">
                <div class="photo_full_box imageflow"id="starsIF">
                    @foreach($photoes as $k=>$v)
                        <img src="{{url($v['PhotosUrl'])}}" title="创建日期：{{date('Y年m月d日',$v['CreateTime'])}}">
                    @endforeach
                </div>
            </div>
        @endif
        <div style="height: 50px;background-color:#fff;"></div>
    </div>
@endsection

@section('footer')
    {{--修改头像弹窗--}}
    <div style="display: none" class="out_biv"></div>
    <div class="W_layer W_layer_div" style="display: none">
        <div tabindex="0"></div>
        <div class="content" style="height: 300px;">
            <div class="W_layer_title">Wejoy微距</div>
            <div class="W_layer_close">
                <a href="javascript:void(0);" class="W_ficon ficon_close S_ficon" onclick="closeIcon()">X</a>
            </div>
            <div class="W_layer_content">
                <form action="{{url('/home/user/editIcon')}}" enctype="multipart/form-data" method="post" id="EditIcon_form" onsubmit="return false">
                    <div class="fans_status" style="height: 200px;">
                        <div>
                            <img src="<?= empty($userinfo->icon)?url('/home/1.jpg'):url($userinfo->icon) ?>" width="100" height="100">

                        </div>
                        <div style="margin: 0 auto;">
                            {{csrf_field()}}
                            <input type="file" name="icon" id="EditIcon_input" style="line-height: normal;float: right;">
                            <input type="hidden" name="icontype" value="" id="iconType_input">
                            <input type="hidden" name='name' value="{{Hashids::encode(Cookie::get('UserId'))}}">
                        </div>
                    </div>
                    <div class="ficon_close_div" id="ficon_close_div">
                        <a class="btn btn-warning ficon_close" id="EditIcon_btn" onclick="doEditIcon(this)">
                            确定<span></span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--添加照片--}}
    <div class="W_layer addPhoto_div" style="display: none">
        <div tabindex="0"></div>
        <div class="content">
            <div class="W_layer_title">Wejoy微距</div>
            <div class="W_layer_close">
                <a href="javascript:void(0);" class="W_ficon ficon_close S_ficon" onclick="closeIcon()">X</a>
            </div>
            <div class="W_layer_content">
                <form id="addPhoto_form" enctype="multipart/form-data" action="{{url('/home/user/addPhoto/'.$Aid)}}"  method="post" onsubmit="return false">
                    {{csrf_field()}}
                    <input type="hidden" name="facetype" value="" id="facetype_input">
                    <div class="form-group">
                        <label id="Photo_name">照片名<span style="color: red"></span></label>
                        <input type="text" class="form-control" name="PhotosName" value="<?= date("Ymd-His-",time()).uniqid() ?>">
                    </div>
                    <div class="form-group">
                        <label>照片描述<span></span></label>
                        <textarea name="PhotosDescription" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label id="Photos_img">上传照片<span style="color: red"></span></label>
                        <input type="file" name="PhotosUrl" id="PhotosUrl_input" value="">
                    </div>
                    <div class="ficon_close_div" id="ficon_close_div">
                        <a class="btn btn-warning ficon_close" id="Photos_btn" onclick="doAddPhoto(this)">
                            确定
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('home/public/footer')
@endsection
@endif