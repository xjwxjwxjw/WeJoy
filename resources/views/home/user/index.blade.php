@if(!Cookie::has('UserId'))
    <script>window.location.href = '/home/index'</script>
    {{--用中间件判断--}}
@else
    @extends('/home/layouts/user')
    @section('title','Wejoy')
    @section('js_css')
        @include('/home/public/js_css')
        <link rel="stylesheet" href="{{url('/home/css/index.css')}}">
        <script src={{url('/home/js/usermasonry.js')}}></script>
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
                    <div class="shadow  S_shadow" layout-shell="false">
                        <div class="pf_photo">
                            <p class="photo_wrap">
                                <a href="javascript:void(0);"title="更换头像" onclick="editIcon()">
                                    <img src='<?= empty($userinfo->icon)?url('/home/1.jpg'):url($userinfo->icon) ?>' alt="{{Cookie::get('UserNickname')}}" class="photo" width="100" height="100">{{--头像--}}
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
                            <td class="current">
                                <a href="{{url('/home/user/index')}}" class="tab_link">
                                    <span class="S_txt1 t_link">我的主页</span>
                                    <span class="ani_border"></span>
                                </a>
                            </td>
                            <td>
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
        <?php
            $fansed = count(\App\UserFans::where('uid_ed',Cookie::get('UserId'))->where('status',1)->get());
            $fans = count(\App\UserFans::where('uid',Cookie::get('UserId'))->where('status',1)->get());
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
                <div id="Pl_Core_UserInfo__6">
                    <div style="visibility: hidden;"></div>
                    <div style="z-index: 10; transform: translateZ(0px); position: relative; transition: margin-top 0.3s ease; will-change: margin-top, top;" class=" ">
                        <div class="WB_cardwrap S_bg2">
                            <!-- v6 card 通用标题 -->
                            <div class="PCD_person_info">
                                <div class="WB_innerwrap">
                                    <div class="m_wrap">
                                        <div class="bars_box">
                                            <?php
                                                $isFull = 0;
                                                $number = 0;
                                                foreach ($user as $k=>$v){
                                                    if ( $k != 'password'&& $k !='name' && $k != 'phone' && $k != 'email'){
                                                        continue;
                                                    }
                                                    if ($v == '' || $v == null ){
                                                        $number++;
                                                        continue;
                                                    }
                                                    $number++;
                                                    $isFull++;
                                                }
                                                foreach ($userinfo as $k=>$v){
                                                    if($k =='id' || $k == 'uid' || $k == 'update_time'){
                                                        continue;
                                                    }
                                                    if ($v == '' || $v == null ){
                                                        $number++;
                                                        continue;
                                                    }
                                                    $number++;
                                                    $isFull++;
                                                }
                                                $length = round($isFull / $number,4)*100;
                                            ?>
                                            <p class="bar_title">个人资料完成度<span class="num"><?= $length ?>%</span></p>
                                            <div class="bar_box S_bg1">
                                                <div class="bar" style="width:<?= $length ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="WB_cardmore S_txt1 S_line1 clearfix" href="{{url('/home/user/info')}}">
                                    <span class="more_txt">编辑个人资料&nbsp;
                                        <em class="W_ficon ficon_arrow_right S_ficon">></em>
                                    </span>
                                </a>

                            </div>
                        </div>
                        <div style="height:1px;margin-top:-1px;visibility:hidden;">
                        </div>
                    </div>
                </div>
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
                                        <a href="{{url('/home/user/photo')}}" target="_blank" class="S_txt1">相册</a>
                                    </span>
                                </h4>
                            </div>
                            <div class="WB_innerwrap">
                                <div class="m_wrap">
                                    <ul class="clearfix">
                                        <?php
//                                            $img = Photoes::;
                                        ?>
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
                            <a href="{{url('/home/user/photo')}}" class="WB_cardmore S_txt1 S_line1 clearfix">
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
                                    <h2 class="main_title W_fb W_f14">公开分组</h2>
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
                                                    <a class="S_txt1" target="_blank" href="">搞笑幽默 14</a>
                                                </h2>
                                            </div>
                                            <div class="opt_btn">
                                                <a href="javascript:void(0);" class="W_btn_b btn_22px btn">推荐</a>
                                            </div>
                                        </div>
                                        <ul class="picitems_ul clearfix">
                                            <li class="picitems">
                                                <div class="midbox">
                                                    <p class="pic_wrap">
                                                        <span class="pic_box">
                                                            <a target="_blank" href="">
                                                                <img class="pic" src="" width="50" height="50" alt="每日笑话微博" title="每日笑话微博">
                                                            </a>
                                                        </span>
                                                    </p>
                                                    <p class="name W_tc">
                                                        <a target="_blank" href="" class="S_txt1" title="每日笑话微博">每日笑话微博</a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="picitems">
                                                <div class="midbox">
                                                    <p class="pic_wrap">
                                                        <span class="pic_box">
                                                            <a target="_blank" href="">
                                                                <img class="pic" src="" width="50" height="50" alt="全球热门搜罗" title="全球热门搜罗">
                                                            </a>
                                                        </span>
                                                    </p>
                                                    <p class="name W_tc">
                                                        <a target="_blank" href="" class="S_txt1" title="全球热门搜罗">全球热门搜罗</a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="picitems">
                                                <div class="midbox">
                                                    <p class="pic_wrap">
                                                        <span class="pic_box">
                                                            <a target="_blank" href="">
                                                                <img class="pic" src="" width="50" height="50" alt="搞笑乐活族" title="搞笑乐活族" >
                                                            </a>
                                                        </span>
                                                    </p>
                                                    <p class="name W_tc">
                                                        <a target="_blank" href="" class="S_txt1" title="搞笑乐活族">搞笑乐活族</a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="picitems">
                                                <div class="midbox">
                                                    <p class="pic_wrap">
                                                        <span class="pic_box">
                                                            <a target="_blank" href="">
                                                                <img class="pic" src="" width="50" height="50" alt="笑话热门榜" title="笑话热门榜" >
                                                            </a>
                                                        </span>
                                                    </p>
                                                    <p class="name W_tc">
                                                        <a target="_blank" href="" class="S_txt1" title="笑话热门榜">笑话热门榜</a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="picitems">
                                                <div class="midbox">
                                                    <p class="pic_wrap">
                                                        <span class="pic_box">
                                                            <a target="_blank" href="">
                                                                <img class="pic" src="" width="50" height="50" alt="笑话热门榜" title="笑话热门榜" >
                                                            </a>
                                                        </span>
                                                    </p>
                                                    <p class="name W_tc">
                                                        <a target="_blank" href="" class="S_txt1" title="笑话热门榜">笑话热门榜</a>
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
                <div id="Pl_Official_LikeMerge__15">
                    {{--<div class="WB_cardwrap S_bg2">--}}
                        {{--<div class="PCD_pictext_f">--}}
                            {{--<div class="WB_cardtitle_b S_line2">--}}
                                {{--<div class="obj_name"><h2 class="main_title W_fb W_f14">赞</h2></div>--}}
                            {{--</div>--}}
                            {{--<div class="WB_innerwrap">--}}
                                {{--<div class="m_wrap">--}}
                                    {{--<div class="pic_list_B">--}}
                                        {{--<ul class="pt_ul clearfix">--}}
                                            {{--<li class="pt_li pt_li_a">--}}
                                                {{--<div class="pic_txt clearfix">--}}
                                                    {{--<div class="pic_box">--}}
                                                        {{--<a target="_blank" href="">--}}
                                                            {{--<img src={{url('home/1.jpg')}} class="pic">--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="info_box S_bg1">--}}
                                                        {{--<div class="text_box">--}}
                                                            {{--<div class="title W_autocut">--}}
                                                                {{--<a target="_blank" href="" class="S_txt1">微博名字</a>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="subtitle W_autocut">--}}
                                                                {{--<a class="S_txt1" target="_blank" href="">假装这里面有一段很长很长的内容，所以你怕不怕，继续凑字数​​​​</a>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<a bpfilter="page" href="" class="WB_cardmore S_txt1 S_line1 clearfix">--}}
                                {{--<span class="more_txt">--}}
                                    {{--查看更多&nbsp;<em class="W_ficon ficon_arrow_right S_ficon">></em>--}}
                                {{--</span>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div id="Pl_Official_MyPopularity__16"></div>
                <div id="Pl_Guide_Bigday__17"></div>
                <div id="Pl_Official_SeoInfo__18"></div>
                <div id="Pl_Core_RecommendFeed__19"></div>
            </div>
    @endsection

    @section('slideRight')
        <div class="col-md-8">
            <div class="box-content" id="box-content" style="float:left;position: relative;">
                <div id="imloading" class="well well-sm" style=" text-align: center;position: absolute;bottom:-70px;width:602px;z-index:999;background:#f2dede;display:none;" >I'm Loading...</div>
                  <ul style="list-style:none;" id="test">
                    <li class='panel panel-default boxtest'>
                        <div>
                            <div class="Wejoy_feed_detail clearfix">
                                <div class="Wejoy_face bg2"></div>
                                <div></div>
                                <div class="Wejoy_detail">
                                    <div class="WJ_info clearfix">
                                        <span class="left">Test</span>
                                        <div class="dropdown">
                                          <a class="right dropdown-toggle Wj_cursons" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                          </a>
                                          <ul class="dropdown-menu WJ-menu-right dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">帮上头条</a></li>
                                            <li><a href="#">屏蔽这条微博</a></li>
                                            <li><a href="#">屏蔽该用户</a></li>
                                            <li><a href="#">取消关注该用户</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">举报</a></li>
                                          </ul>
                                        </div>
                                    </div>
                                    <div class="WJ_text clearfix">今天 09:02 来自 微博 weibo.com</div>
                                    <div class="WJ_text2 clearfix">我们不是出生在一个和平的年代，而是一个和平的国家。</div>
                                    <div class="Wj_media_wrap clearfix bg2"></div>
                                </div>
                            </div>
                            <div class="WJ_feed_handle clearfix">
                                <ul class="WJ_row_line row">
                                    <li class="left"><span class="glyphicon glyphicon-star-empty pos" >收藏</span></li>
                                    <li class="left"><span class="glyphicon glyphicon-share" > 999</span></li>
                                    <li class="left"><span class="glyphicon glyphicon-comment" > 666</span></li>
                                    <li class="left"><span class="glyphicon glyphicon-thumbs-up" > 129</span></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                  </ul>
                </div>
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
                <div class="webim_hb" style="top:-10px; left:200px;display:none;
        background: url({{url('/home/webim_hb_small.gif')}}) 0 0 no-repeat;"></div>
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
        {{--修改头像弹窗--}}
        <div style="display: none" class="out_biv"></div>
        <div class="W_layer W_layer_div" style="display: none">
            <div tabindex="0"></div>
            <div class="content">
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
        @include('home/public/footer')
    @endsection
@endif
