@extends('/home/layouts/user')
@section('title','Wejoy')
@section('js_css')
    @include('/home/public/js_css')
    <style>
        body{padding-left: 0px;}
    </style>
@endsection
@section('top')
    @include('/home/public/top')
@endsection

@section('slideTop')
        <div class="col-md-12">
            <div id="Pl_Official_Headerv6__1"><div class="PCD_header">
                    <div class="pf_wrap" layout-shell="false" node-type="cover_wrap">
                        <div class="cover_wrap banner_transition" node-type="cover" style="background-image:url()">
                            {{--上面url为背景图片--}}
                        </div>
                        <div class="shadow  S_shadow" layout-shell="false">
                            <div class="pf_photo" node-type="photo">
                                <p class="photo_wrap">
                                    <a href="javascript:void(0);" action-type="setPhoto" title="更换头像">
                                        <img src="" alt="姓名" class="photo">{{--头像--}}
                                    </a>
                                </p>
                            </div>
                            <div class="pf_username">
                                <h1 class="username">姓名</h1>
                                <span class="icon_bed"><a><i class="W_icon icon_pf_male"></i></a></span>
                            </div>


                            <div class="pf_intro" title="个性签名">个性签名</div>
                        </div>
                        <div class="upcover">
                            <a href="javascript:void(0);" class="W_btn_b" node-type="custom" style="display: none;">
                                <em class="W_ficon ficon_upload S_ficon"></em>上传封面图
                            </a></div>
                        <div style="display: none;" class="pf_use_num">超过<span class="W_Tahoma W_fb">100</span>万人正在使用</div>
                        <a href="javascript:void(0)" suda-data="key=tblog_mode_cover&amp;value=profile_home_tear" action-data="is_guilderBubble=" node-type="set_skin" title="模板设置" class="W_icon icon_setskin UI_top_hidden W_fixed_top" ontouchstart=""></a>
                    </div>
                </div>
                <div node-type="moreList" class="layer_menu_list_b" style="position:absolute; top:332px; left:900px; z-index:999;display: none;">
                    <div class="list_wrap">
                        <div class="list_content W_f14">
                            <ul class="list_ul">
                                <li class="item"><a suda-data="key=tblog_otherprofile_v5&amp;value=whisper" href="javascript:void(0);" action-type="addQuietFollow" action-data="fuid=5629571150&amp;fname=土逼卷头门&amp;action=add" class="tlink" suda-uatrack="key=tblog_profile_v6&amp;value=silently_concern">悄悄关注</a></li>
                                <li class="item"><a action-data="title=%E6%8A%8A%E5%9C%9F%E9%80%BC%E5%8D%B7%E5%A4%B4%E9%97%A8%E6%8E%A8%E8%8D%90%E7%BB%99%E6%9C%8B%E5%8F%8B&amp;content=%E5%BF%AB%E6%9D%A5%E7%9C%8B%E7%9C%8B%E5%9C%9F%E9%80%BC%E5%8D%B7%E5%A4%B4%E9%97%A8%20%E7%9A%84%E5%BE%AE%E5%8D%9Ahttp://weibo.com/u/5629571150" href="javascript:void(0);" action-type="widget_publish" class="tlink" suda-uatrack="key=tblog_profile_v6&amp;value=suggest_to_friends">推荐给朋友</a></li>
                            </ul>
                            <ul class="list_ul">
                                <li class="item"><a suda-data="key=tblog_otherprofile_v5&amp;value=join_blacklist" href="javascript:void(0);" action-type="block" class="tlink" suda-uatrack="key=tblog_profile_v6&amp;value=in_black_list">加入黑名单</a></li>
                                <li class="item"><a suda-data="key=tblog_otherprofile_v5&amp;value=report" href="javascript:void(0);" onclick="javascript:window.open('http://service.account.weibo.com/reportspam?rid=5629571150&amp;from=10106&amp;type=3&amp;url=%2F5629571150%2Fprofile&amp;bottomnav=1&amp;wvr=5', 'newwindow', 'height=700, width=550, toolbar =yes, menubar=no, scrollbars=yes, resizable=yes, location=no, status=no');" class="tlink" suda-uatrack="key=tblog_profile_v6&amp;value=report">举报他</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('slideLeft')
        <div class="col-md-4">
            <div style="border:1px solid #000;height:500px"></div>
        </div>
@endsection

@section('slideRight')
        <div class="col-md-8">
            <div style="border:1px solid #000;height:500px"></div>
        </div>
@endsection

@section('footer')
    @include('home/public/footer')
@endsection