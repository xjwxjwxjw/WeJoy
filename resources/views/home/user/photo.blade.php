<?php
    var_dump($id);
    var_dump($album);
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
                                        <li class="item"><a href="javascript:void(0);" class="tlink">加入关注</a></li>
                                        <li class="item"><a href="javascript:void(0);" class="tlink">加入黑名单</a></li>
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
                                <td class="current">
                                    <a href="" class="tab_link">
                                        <span class="S_txt1 t_link">Ta的主页</span>
                                        <span class="ani_border"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="tab_link">
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
        <?php
        $fansed = count(\App\UserFans::where('uid_ed',$user->id)->where('status',1)->get());
        $fans = count(\App\UserFans::where('uid',$user->id)->where('status',1)->get());
        ?>
        <div class="col-md-4">
            <div id="Pl_Core_T8CustomTriColumn__3">
                <div class="WB_cardwrap S_bg2">
                    <div class="PCD_counter">
                        <div class="WB_innerwrap">
                            <table class="tb_counter" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td class="S_line1">
                                        <a class="t_link S_txt1" href="">
                                            <strong class="W_f18">{{$fans}}</strong>
                                            <span class="S_txt2">关注</span>
                                        </a>
                                    </td>
                                    <td class="S_line1">
                                        <a class="t_link S_txt1" href="">
                                            <strong class="W_f18">{{$fansed}}</strong>
                                            <span class="S_txt2">粉丝</span>
                                        </a>
                                    </td>
                                    <td class="S_line1">
                                        <a class="t_link S_txt1" href="">
                                            <strong class="W_f18">37</strong>
                                            <span class="S_txt2">微博</span>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Pl_Core_ThirdHtmlData__4"></div>
            <div id="Pl_Third_Inline__5"></div>
            <div id="Pl_Core_UserInfo__6"></div>
            <div id="Pl_Third_Inline__7"></div>
            <div id="Pl_Core_UserGrid__8"></div>
            <div id="Pl_Core_Pt13PicText__9"></div>
            <div id="Pl_Third_Inline__10">
                <div class="WB_cardwrap S_bg2">
                    <!--个人图片-->
                    <div class="PCD_photolist">
                        <div class="WB_cardtitle_b S_line2">
                            <h4 class="obj_name">
                                    <span class="main_title W_fb W_f14">
                                        <a href="" target="_blank" class="S_txt1">相册</a>
                                    </span>
                            </h4>
                        </div>
                        <div class="WB_innerwrap">
                            <div class="m_wrap">
                                <ul class="clearfix">
                                    <li class="big_pic">
                                        <a href="" target="_blank">
                                            <img src="">
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="" target="_blank">
                                            <img src="">
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="" target="_blank">
                                            <img src="">
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="" target="_blank">
                                            <img src="" width="72" height="72">
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="" target="_blank">
                                            <img src="" width="72" height="72">
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="" target="_blank">
                                            <img src="" width="72" height="72">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="" class="WB_cardmore S_txt1 S_line1 clearfix">
                                <span class="more_txt">
                                    查看更多<em class="W_ficon ficon_arrow_right S_ficon">></em>
                                </span>
                        </a>
                    </div>
                    <!--/个人图片-->
                </div>
            </div>
            <div id="Pl_Core_Pt6Rank__11"></div>
            <div id="Pl_Core_UserGrid__12">
                <div class="WB_cardwrap S_bg2">
                    <div class="PCD_user_a PCD_user_a1">
                        <!-- v6 card 通用标题 -->
                        <div class="WB_cardtitle_b S_line2">
                            <!-- 标题 -->
                            <div class="obj_name">
                                <h2 class="main_title W_fb W_f14">微关系</h2>
                            </div>
                            <!-- 标题栏控件 -->
                        </div>
                        <div class="WB_innerwrap">
                            <!-- 标题栏筛选项 -->
                            <div class="m_wrap clearfix">
                                <div class="m_box S_line2">
                                    <div class="WB_cardtitle_c">
                                        <div class="obj_name">
                                            <h2 class="main_title W_fb W_f14">
                                                <a class="S_txt1" target="_blank" href="">微关系</a>
                                            </h2>
                                        </div>
                                    </div>
                                    <ul class="picitems_ul clearfix">
                                        <li class="picitems">
                                            <div class="midbox">
                                                <p class="pic_wrap">
                                                                <span class="pic_box">
                                                                    <a target="_blank" href="">
                                                                        <img class="pic" src="" width="50" height="50" alt="这是共同关注" title="这是共同关注">
                                                                    </a>
                                                                </span>
                                                </p>
                                                <p class="name W_tc">
                                                    <a target="_blank" href="" class="S_txt1" title="这是共同关注">这是共同关注</a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a class="WB_cardmore S_txt1 S_line1 clearfix" href="">
                                <span class="more_txt">查看更多&nbsp;
                                    <em class="W_ficon ficon_arrow_right S_ficon">></em>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="Pl_Core_PicText__13"></div>
            <div id="Pl_Core_Ut1UserList__14"></div>
            <div id="Pl_Official_LikeMerge__15"></div>
            <div id="Pl_Official_MyPopularity__16"></div>
            <div id="Pl_Guide_Bigday__17"></div>
            <div id="Pl_Official_SeoInfo__18"></div>
            <div id="Pl_Core_RecommendFeed__19"></div>
        </div>
    @endsection
    @section('slideRight')
        <div class="photo_box col-md-8">
            @if(empty($album))
                <div class="profile_photo">
                    <div class="photo_null_box"><span class="glyphicon glyphicon-remove"></span>暂无相册</div>
                </div>
            @else
                <div class="profile_photo">
                    <div class="photo_full_box">
                        @foreach($album as $k=>$v)
                            <div class="photo sample3 ablum_div" id=<?= 'ablum_'.$v['id'] ?>>
                                <a href="{{url('/home/user/photo/'.Hashids::encode($id).'/'.$v['id'])}}" title="创建日期：{{date('Y年m月d日',$v['CreateTime'])}}">
                                    <span style="background: url({{url('/home/paper-clip.png')}}) no-repeat;"></span>
                                    <?php
                                    if(!empty($v['FaceUrl'])) {
                                        $faceUrl = $v['FaceUrl'];
                                    }else{
                                        $selectUrl = DB::table('photoes')->select('PhotosUrl')->where('Aid',$v['id'])->first();
                                        if (!empty($selectUrl)){
                                            $faceUrl = $selectUrl;
                                        }else{
                                            $faceUrl = '/image/face_default.jpg';
                                        }
                                    }
                                    ?>
                                    <img src={{url($faceUrl)}} alt="image">
                                </a>
                                <a href="{{url('/home/user/photo/'.Hashids::encode($id).'/'.$v['id'])}}" class="album_a">
                                    <div class="photo_name_box" title="{{$v['AlbumName']}}">{{$v['AlbumName']}}</div>
                                </a>
                                <a href="{{url('/home/user/photo/'.Hashids::encode($id).'/'.$v['id'])}}" class="album_a">
                                    <div class="photo_description_box" title="{{$v['AlbumDescription']}}">{{$v['AlbumDescription']}}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div style="height: 50px;background-color:#fff;"></div>
        </div>
    @endsection
    @section('footer')
        <a class="W_gotop" id="base_scrollToTop" href="javascript:void(0);" style="visibility: visible; transform: translateZ(0px); position: fixed; bottom: 40px; top: auto;">
            <em class="W_ficon ficon_backtop">TOP</em>
        </a>

        <div id="WB_webim" class="WB_webim" style="position: fixed; bottom: 0px; right: 0px; z-index: 1024;">
            <iframe id="cometd_imsdk_1" style="position: absolute; left: -100px; top: -100px; height: 1px; width: 1px; visibility: hidden;"></iframe>
            <div class="webim_fold webim_fold_v2 clearfix" style="top: -40px; right: 0px; visibility: visible;">
                <div class="fold_bg">
                    <p class="fold_cont clearfix">
                        <span class="fold_icon W_fl" style="background: url({{url('/home/webim_icon.png')}}) 0 -20px no-repeat;"></span>
                        <em class="fold_font W_fl W_f14" >私信聊天</em>
                        <span class="wchat_btn W_fr">
                                <em class="wchat_icon" style="background: url({{url('/home/webchat_icon.png')}}) 0 -30px no-repeat;"></em>
                            </span>
                    </p>
                </div>
                <div class="webim_hb" style="top:-10px; left:200px;display:none;background: url({{url('/home/webim_hb_small.gif')}}) 0 0 no-repeat;"></div>
                <div class="W_layer W_layer_pop W_layer_pop_rg" style="bottom:50px;left:0px;display:none;">
                    <div class="content layer_mini_info">
                        <p class="main_txt">
                            <span class="txt">全新的聊天工具来啦！更畅快的聊天体验，猛戳试用</span>
                        </p>
                        <div class="W_layer_arrow">
                                    <span class="W_arrow_bor W_arrow_bor_b">
                                        <i class="S_line3"></i>
                                        <em class="S_bg2_br"></em>
                                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('home/public/footer')
    @endsection
@else
    <script>window.location.href = '/home/index'</script>
@endif
