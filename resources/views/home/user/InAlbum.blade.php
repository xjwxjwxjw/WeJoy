{{--别人--}}
<?php
$user = DB::table('homeuser')->where('id',$id)->get();
$userinfo = DB::table('homeuserinfo')->where('uid',$id)->get();
?>
@if(!empty($user[0]))
    <?php
    $user = $user[0];
    $userinfo = $userinfo[0];
    ?>
    @extends('/home/layouts/user')
    @section('title','Wejoy')
@section('js_css')
    @include('/home/public/js_css')
    <link rel="stylesheet" href="{{url('/home/css/index.css')}}">
    <link rel="stylesheet" href="{{url('/home/css/user/user.css')}}">
    <script src={{url('/home/js/usermasonry.js')}}></script>
    <link rel="stylesheet" href="{{url('/home/css/user/photo.css')}}">
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
    <div class="col-md-12">
        <div id="Pl_Official_Headerv6__1" class="text-center">
            <div class="PCD_header">
                <div class="pf_wrap" style="background-image:url({{url('/home/bg.jpg')}});background-size:100% 100%;">
                    {{--上面url为背景图片--}}
                    <div class="shadow  S_shadow">
                        <div class="pf_photo">
                            <p class="photo_wrap">
                                <img src='<?= empty($userinfo->icon)?url('/image/default.jpg'):url($userinfo->icon) ?>' alt={{$user->name}} class="photo" width="100" height="100">{{--头像--}}
                            </p>
                        </div>
                        <div class="pf_username">
                            <h1 class="username">{{$user->name}}</h1>
                            <span class="icon_bed">
                                        <a>
                                            <i class="W_icon icon_pf_male" style="background-image:url({{url('/home/icon.png')}});background-position: <?= $userinfo->sex==1?'-100px':($userinfo->sex==2?'-125px':'-350px') ?> -50px;"></i>
                                        </a>
                                    </span>
                        </div>
                        <div class="pf_intro" title="<?= empty($userinfo->signature)?'主人很懒，还没有写个性签名呐':$userinfo->signature ?>">
                            <?= empty($userinfo->signature)?'主人很懒，还没有写个性签名呐':$userinfo->signature ?>
                        </div>
                    </div>
                    <div class="fb_box">
                        <div class="list_wrap">
                            <div class="fb_div">
                                <ul class="list_ul">
                                    <li style="display: none" id="ByName">{{Hashids::encode(Cookie::get('UserId'))}}</li>
                                    <li style="display: none" id="BaName">{{Hashids::encode($id)}}</li>
                                    @if(count(\App\UserFans::where('uid',$id)->where('uid_ed',Cookie::get('UserId'))->where('status',1)->get()))
                                        <li class="item">
                                            <a href="javascript:void(0);" class="tlink cancel" onclick="doFans(this)">取消关注</a>
                                        </li>
                                    @else
                                        <li class="item">
                                            <a href="javascript:void(0);" class="tlink addtofans" onclick="doFans(this)">加入关注</a>
                                        </li>
                                    @endif
                                    @if(count(\App\UserFans::where('uid',$id)->where('uid_ed',Cookie::get('UserId'))->where('status',2)->get()))
                                        <li class="item">
                                            <a href="javascript:void(0);" class="tlink cancel" onclick="doFans(this)">移出黑名单</a>
                                        </li>
                                    @else
                                        <li class="item">
                                            <a href="javascript:void(0);" class="tlink addtofans" onclick="doFans(this)">加入黑名单</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="Pl_Official_Nav__2">
            <div class="PCD_tab S_bg2">
                <div class="tab_wrap" style="width:60%">
                    <table class="tb_tab" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <a href="{{url('/home/user/'.Hashids::encode($id))}}" class="tab_link">
                                    <span class="S_txt1 t_link">Ta的主页</span>
                                    <span class="ani_border"></span>
                                </a>
                            </td>
                            <td class="current">
                                <a href="{{url('/home/user/photo/'.Hashids::encode($id))}}" class="tab_link">
                                    <span class="S_txt1 t_link">Ta的相册</span>
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
    <div class="photo_box col-md-12">
        @if(empty($album))
            <div class="profile_photo">
                <div class="photo_null_box"><span class="glyphicon glyphicon-remove"></span>暂无图片</div>
            </div>
        @elseif(count($album) < 6)
            <div class="profile_photo">
                <div class="photo_full_box photoes_full_box">
                    @foreach($album as $k=>$v)
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
                    @foreach($album as $k=>$v)
                        <img src="{{url($v['PhotosUrl'])}}" title="创建日期：{{date('Y年m月d日',$v['CreateTime'])}}">
                    @endforeach
                </div>
            </div>
        @endif
        <div style="height: 50px;background-color:#fff;"></div>
    </div>
@endsection

@section('footer')
@endsection
@else
    <script>window.location.href = '/home/index'</script>
@endif
