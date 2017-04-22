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
            <div id="Pl_Core_ThirdHtmlData__4">
                <div class="WB_cardwrap S_bg2">
                    <div class="PCD_counter">
                        <div class="WB_innerwrap">
                            <div class="WB_cardtitle_b S_line2">
                                <h4 class="obj_name">
                                    <span class="main_title W_fb W_f14">
                                        <a href="{{url('/home/user/photo')}}" target="_blank" class="S_txt1">相册</a>
                                    </span>
                                </h4>
                            </div>
                            <div class="photo_btn_box">
                                <a href="javascript:void(0)" class="photo_btn" onclick="addAlbum()">马上添加</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Pl_Third_Inline__5"></div>
            <div id="Pl_Core_UserInfo__6"></div>
            <div id="Pl_Third_Inline__7"></div>
            <div id="Pl_Core_UserGrid__8"></div>
            <div id="Pl_Core_Pt13PicText__9"></div>
            <div id="Pl_Third_Inline__10"></div>
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
                                <a href="{{url('/home/user/photo/my/'.Hashids::encode($v['id']))}}" title="创建日期：{{date('Y年m月d日H:i:s',$v['CreateTime'])}}">
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
                                <a href="javascript:void(0)" onclick="changeAlbum(this)" name="AlbumName" class="album_a">
                                    <div class="photo_name_box" title="{{$v['AlbumName']}}">{{$v['AlbumName']}}</div>
                                </a>
                                <a href="javascript:void(0)" onclick="changeAlbum(this)" name="AlbumDescription" class="album_a">
                                    <div class="photo_description_box" title="{{$v['AlbumDescription']}}">{{$v['AlbumDescription']}}</div>
                                </a>
                                <a href="javascript:void(0)" class="album_btn" onclick="delablum(this)">删除该相册</a>
                            </div>
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
        {{--添加相册--}}
        {{--<div style="display: none" class="out_biv"></div>--}}
        <div class="W_layer addAlbum_div " style="display: none">
            <div tabindex="0"></div>
            <div class="content">
                <div class="W_layer_title">Wejoy微距</div>
                <div class="W_layer_close">
                    <a href="javascript:void(0);" class="W_ficon ficon_close S_ficon" onclick="closeIcon()">X</a>
                </div>
                <div class="W_layer_content">
                    <form id="addAlbum_form" enctype="multipart/form-data" action="{{url('/home/user/addAlbum')}}"  method="post" onsubmit="return false">
                          {{csrf_field()}}
                          <input type="hidden" name="facetype" value="" id="facetype_input">
                          <div class="form-group">
                              <label id="Album_name">相册名<span style="color: red"></span></label>
                              <input type="text" class="form-control" placeholder="必填" name="AlbumName" value="">
                          </div>

                          <div class="form-group">
                              <label>相册描述<span></span></label>
                              <textarea name="AlbumDescription" cols="30" rows="10" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                              <label>相册状态<span></span></label>
                              <select class="form-control" name="AlbumPermissions">
                                  <option value="1">公开（所有人可见）</option>
                                  <option value="2">权限（仅粉丝可见）</option>
                                  <option value="3">私人（仅自己可见）</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label id="Album_face">上传封面<span style="color: red"></span></label>
                              <input type="file" name="face" id="AlbumFace_input" value="">
                          </div>
                          <div class="ficon_close_div" id="ficon_close_div">
                              <a class="btn btn-warning ficon_close" id="AlbumFace_btn" onclick="doAddAlbum(this)">
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