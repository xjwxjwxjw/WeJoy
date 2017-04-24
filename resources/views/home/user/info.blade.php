{{--自己--}}
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
        <link rel="stylesheet" href="{{url('/home/css/user/info.css')}}">
{{--        <script src={{url('/home/js/usermasonry.js')}}></script>--}}
        <script src={{url('/home/js/login.js')}}></script>
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
                                            <a class="t_link S_txt1" href="{{url('/home/user/fans/'.Hashids::encode(Cookie::get('UserId')))}}">
                                                <strong class="W_f18">{{$fansed}}</strong>
                                                <span class="S_txt2">关注</span>
                                            </a>
                                        </td>
                                        <td class="S_line1">
                                            <a class="t_link S_txt1" href="{{url('/home/user/fansed/'.Hashids::encode(Cookie::get('UserId')))}}">
                                                <strong class="W_f18">{{$fans}}</strong>
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
                            <?php
                                $album_random = \App\Album::where('uid',Cookie::get('UserId'))->where('AlbumPermissions',1)->first();
                            ?>
                            @if (empty($album_random))
                                <div class="WB_innerwrap">
                                    <div class="m_wrap">
                                        <br>
                                        你还没有丰富自己的相册哦！
                                    </div>
                                </div>
                            @else
                                <?php
                                $Aid_random = $album_random->toArray()['id'];
                                $photoes = \App\Photoes::all()->where('Aid',$Aid_random)->toArray();
                                $first_photo = array_shift($photoes);
                                ?>
                                <div class="WB_innerwrap">
                                    <div class="m_wrap">
                                        <ul class="clearfix">
                                            @if(count($first_photo) > 0)
                                                <li class="big_pic">
                                                    <img src="{{url($first_photo['PhotosUrl'])}}">
                                                </li>
                                            @else
                                                <li style="width: 100%;font-weight: bold;line-height: 75px;margin-left: 40%;">主人还没添加相册哦</li>
                                            @endif
                                        @if(count($photoes) <= 5)
                                            @foreach($photoes as $v)
                                                <li class="">
                                                    <img src="{{url($v['PhotosUrl'])}}">
                                                </li>
                                            @endforeach
                                        @else
                                            <?php $photoes = array_slice($photoes,0,5) ?>
                                            @foreach($photoes as $value)
                                                <li class="">
                                                    <img src="{{url($value['PhotosUrl'])}}">
                                                </li>
                                            @endforeach
                                        @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
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
                <div id="Pl_Core_UserGrid__12"></div>
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
        <div class="WB_cardwrap S_bg2 col-md-8 WJ_cardwrap " style="max-width: 620px;">
            <div class="profile_pinfo" id="pl_content_account">
                <div class="infoblock">
                    <form class="info_title">
                        <fieldset class="S_line2">
                            <legend class="tit S_txt1">基本信息</legend>
                            <div class="btns">
                                <a class="W_btn_round" href="javascript:void(0)" onclick="doEdit(this)">
                                    <span>编辑</span>
                                </a>
                            </div>
                        </fieldset>
                    </form>
                    <div class="edit_info">
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">昵&nbsp;&nbsp;称</div>
                            <div class="con" ><?= $user->name?$user->name:'' ?><a href="" style="margin-left: 20px">修改密码</a></div>

                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">真实姓名</div>
                            <div class="con"><?= $userinfo->name?$userinfo->name:'' ?></div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">所在地</div>
                            <div class="con"><?= $userinfo->address?$userinfo->address:'' ?></div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2"> 性&nbsp;&nbsp;别</div>
                            <div class="con"><?= $userinfo->sex==1?'男':($userinfo->sex==2?'女':'保密') ?></div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">生日</div>
                            <div class="con"><?= $userinfo->birthday?$userinfo->birthday:'' ?></div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">个性签名</div>
                            <div class="con">
                                <?= $userinfo->signature?$userinfo->signature:'<a href="javascript:void(0)" onclick="doEdit(this)">
                                    马上填写
                                </a>自己的个人介绍,让大家快速了解真实的你' ?>
                            </div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">注册时间</div>
                            <div class="con"><?= $user->create_time?date('Y-m-d',$user->create_time):'当前无记录' ?></div>
                        </div>
                    </div>
                    <div style="display:none;" class="edit_info_div">
                        <form onsubmit="return false" class="edit_info_form" autocomplete="off">
                            {{csrf_field()}}
                            <input type="hidden" name="oldnick" value="<?= $user->name ?>">
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">昵&nbsp;&nbsp;称</div>
                                <div class="con">
                                    <input name="nickname" class="W_input" value="<?= $user->name?$user->name:'' ?>">
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">真实姓名</div>
                                <div class="con">
                                    <input type="" class="W_input" name="name" value="<?= $userinfo->name?$userinfo->name:'' ?>"></div>
                                <div class="status">
                                    <div style="display:none" class="W_tips tips_del clearfix"></div>
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">所在地</div>
                                <div class="con">
                                    <div class="input_sel">
                                        <input type="text" name="address" value="<?= $userinfo->address?$userinfo->address:'' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">性&nbsp;&nbsp;别</div>
                                <div class="con">
                                    <div class="input_check">
                                        <span class="rsp">
                                            <label for="man_radio">
                                                <input id="man_radio" name="sex" type="radio" value="1" class="W_radio" <?= $userinfo->sex==1?'checked':''?>>男
                                            </label>
                                        </span>
                                        <span class="rsp">
                                            <label for="woman_radio">
                                                <input id="woman_radio" name="sex" type="radio" value="2" class="W_radio" <?= $userinfo->sex==2?'checked':''?>>女
                                            </label>
                                        </span>
                                        <span class="rsp">
                                            <label for="woman_radio">
                                                <input id="woman_radio" name="sex" type="radio" value="3" class="W_radio" <?= $userinfo->sex==3?'checked':''?>>保密
                                            </label>
                                        </span>
                                        <div class="status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">生日</div>
                                <div class="con">
                                    <div class="input_sel">
                                        <input type="date" name="birthday" value="<?= $userinfo->birthday?$userinfo->birthday:'' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">个性签名</div>
                                <div class="con">
                                    <textarea name="signature" cols="30" rows="10" class="W_input input_text"><?= $userinfo->signature?$userinfo->signature:'' ?></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="infoblock">
                    <form class="info_title">
                        <fieldset class="S_line2">
                            <legend class="tit S_txt1">联系信息</legend>
                            <div class="btns">
                                <a class="W_btn_round" href="javascript:void(0)" onclick="doEdit(this)">
                                    <span>编辑</span>
                                </a>
                            </div>
                        </fieldset>
                    </form>
                    <div class="edit_info">
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">手机</div>
                            <div class="con">
                                <?= $user->phone?$user->phone:'<a href="javascript:void(0)" onclick="doEdit(this)">
                                    马上填写
                                </a>
                                你的手机信息' ?>
                            </div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">邮箱</div>
                            <div class="con">
                                <?= $user->email?$user->email:'<a href="javascript:void(0)" onclick="doEdit(this)">
                                    马上填写
                                </a>
                                你的邮箱信息' ?>
                            </div>
                        </div>
                        <div class="pf_item clearfix">
                            <div class="label S_txt2">QQ</div>
                            <div class="con">
                                <p>
                                    <?= $userinfo->qq?$userinfo->qq:'<a href="javascript:void(0)" onclick="doEdit(this)">
                                    马上填写
                                </a>
                                你的邮箱信息' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="display:none" class="edit_info_div">
                        <form onsubmit="return false" class="edit_info_form" autocomplete="off">
                            {{csrf_field()}}
                            <input type="hidden" name="oldnick" value="<?= $user->name ?>">
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">手机</div>
                                <div class="con">
                                    <input type="" name="phone" class="W_input" value="<?= $user->phone?$user->phone:'' ?>" maxlength="11">
                                    <span style="color: red">注意：修改后验证将发送至修改后的手机</span>
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">邮箱</div>
                                <div class="con">
                                    <input type="" name="email" class="W_input" value="<?= $user->email?$user->email:'' ?>">
                                    <span style="color: red">注意：修改后验证将发送至修改后的邮箱</span>
                                </div>
                            </div>
                            <div class="pf_item clearfix">
                                <div class="label S_txt2">QQ</div>
                                <div class="con"><input type="" name="qq" class="W_input" value="<?= $userinfo->qq?$userinfo->qq:'' ?>"></div>
                            </div>
                        </form>
                    </div>
                {{--</div>--}}
                <!--/个人信息-->
                <script src="" type="text/javascript"></script>
            </div>
            </div>
            <div style="height: 50px"></div>
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