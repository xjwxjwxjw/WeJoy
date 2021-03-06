<div class="WB_main_r">
	<div id="v6_pl_content_setskin">
		{{--此处div为右侧改背景按钮--}}
		<div class="templete_enter UI_top_hidden">
			<a href="javascript:void(0);" class="W_icon icon_setskin" title="模板设置"></a>
		</div>
	</div>
	{{--判断 如果登陆则显示头像 否则显示登陆界面--}}
	@if(!Cookie::has('UserId'))
		{{--登陆界面--}}
		<div class="login_box" id="pl_login_form">
			<div class="login_innerwrap">
				<div class="info_header">
					<div class="tab clearfix">
						<a href="javascript:void(0);" >帐号登录</a>
						{{--<a href="javascript:void(0);" class=" ">安全登录</a>--}}
					</div>
				</div>

				<!-- 登录框content -->
				<div class="W_login_form">
					{{csrf_field()}}
					<!--<div class="info_list pre_info clearfix" node-type="prename_box" style="display:none"></div>-->
					<div class="info_list username">
						<div class="input_wrap">
							<span style="background-image:url({{url('home/sprite_login.png')}});" class="login_username"></span>
							<input id="loginname" type="text" class="W_input" maxlength="128" autocomplete="off" name="username" tabindex="1" placeholder="手机/邮箱/用户名" value="">
						</div>
					</div>
					<div class="info_list password">
						<div class="input_wrap">
							<span style="background-image:url({{url('home/sprite_login.png')}});" class="login_password"></span>
							<input type="password" class="W_input" maxlength="24" autocomplete="off" name="password" value="" tabindex="2" placeholder="请输入密码">
						</div>
					</div>
					<!-- 输入验证码 -->
					<div class="login_prompt send_div" style="display: none">
						<div class="arrow_div"></div>
						<a href="javascript:void(0)" class="close_div" onclick="doClose()">X</a>
						<div style="color: red">用户名或密码有误或账号未激活</div>
					</div>
					<div class="info_list verify clearfix" style="display: none">
						<div class="input_wrap W_fl">
							<input type="text" class="W_input" maxlength="6" autocomplete="off" value="" name="verifycode" tabindex="3" placeholder="验证码" disabled>
						</div>
						<a class="code W_fl" onclick="return false;" href="javascript:void(0);">
							<img width="90" height="34" src="about:blank">
						</a>
					</div>
					<!-- /输入验证码 -->
					<div class="info_list auto_login clearfix">
						<div class="right W_fr">
							<a href="javascript:void(0);" onclick="showmakemm()" class="S_txt2">忘记密码</a>
						</div>
						<label for="login_form_savestate" class="W_fl W_label" title="建议在网吧或公共电脑上取消该选项。">
							<input type="checkbox" id="login_form_savestate" checked="checked" tabindex="5" class="W_checkbox">
							<span class="S_txt2">记住我</span>
						</label>
					</div>
					<div class="info_list login_btn">
						<a href="javascript:void(0)" class="W_btn_a btn_32px" tabindex="6" onclick="npclick(this)" type="button">
							<span>
								登录
							</span>
						</a>
					</div>
					<div class="info_list register">
						<span class="S_txt2">还没有微博？</span>
						<a target="_blank" href="javascript:void(0)" data-toggle='modal' data-target='#myModal'>立即注册!</a>
					</div>
				</div>
				<!-- 短信登陆 -->
				<div class="W_login_form" style="display: none;">
					{{csrf_field()}}
					<div class="info_list phone">
						<div class="input_wrap W_input_focus">
							<input type="text" class="W_input" maxlength="128" autocomplete="off" placeholder="手机号码，仅支持大陆手机" value="" name="username">
						</div>
					</div>
					<div class="info_list msgInfo clearfix">
						<div class="input_wrap W_fr">
							<input type="text" class="W_input" maxlength="6" value="短信验证码" name="password">
						</div>
						<a href="javascript:void(0);" class="W_btn_b btn_32px W_fl">获取短信验证码</a>
						<a style="display:none" href="javascript:void(0);" class="W_btn_b btn_32px W_fl W_btn_b_disable">
							<em>60</em>秒后再获取短信</a>
					</div>
					<div class="info_list auto_login clearfix">
						<div class="right W_fr">
							<a href="" target="_blank" class="S_txt2">忘记密码</a></div>
						<label for="login_form_savestate1" class="login_form_savestate" title="建议在网吧或公共电脑上取消该选项。">
							<input type="checkbox" id="login_form_savestate1" checked="checked" tabindex="5" class="W_checkbox">
							<span class="S_txt2">记住我</span>
						</label>
					</div>
					<div class="info_list login_btn">
						<a class="W_btn_a btn_32px" href="javascript:void(0)">
							<span>登录</span>
						</a>
					</div>
					<div class="info_list register">
						<span class="S_txt2">还没有微博？</span>
						<a target="_blank" href="javascript:void(0)"  data-toggle='modal' data-target='#myModal'>立即注册!</a>
					</div>
				</div>
				<div class="info_list other_login clearfix" style="display: none;">
					<span class="tit W_fl S_txt2">其它登录：</span>
					<div class="other_login_list W_fl">
						<iframe scrolling="no" frameborder="no" src="" allowtransparency="true" style="width: 16px; height: 16px; overflow: hidden;float: left;margin-right: 3px;margin-top: -1px;"></iframe>
						<a target="_blank" href="" class="cp_logo icon_qq"></a>
						<a target="_blank" href="" class="cp_logo icon_yidong"></a>
						<a target="_blank" href="" class="cp_logo icon_tianyi"></a>
						<a target="_blank" href="" class="cp_logo icon_360"></a>
						<a target="_blank" href="" class="cp_logo icon_unicom"></a>
						<a target="_blank" href="" class="cp_logo icon_baidu"></a>
					</div>
				</div>
			</div>
		</div>
	@else
	{{--个人信息--}}
	<?php
        $fansed = count(\App\UserFans::where('uid_ed',Cookie::get('UserId'))->where('status',1)->get());
        $fans = count(\App\UserFans::where('uid',Cookie::get('UserId'))->where('status',1)->get());
        $loginUser = DB::table('homeuserinfo')->where('uid',Cookie::get('UserId'))->get()[0];
        $level = DB::table('level')->where('uid',Cookie::get('UserId'))->get()[0];
	?>
		<div id="v6_pl_rightmod_myinfo">
			<div class="WB_cardwrap S_bg2">
				<div class="W_person_info">
					<div class="cover" id="skin_cover_s" style="background-image:url({{url('/home/bg.jpg')}});background-size:100% 100%;">
						<div class="headpic">
							<a href="{{url('/home/user/index')}}" title="{{Cookie::get('UserNickname')}}">
								<img class="W_face_radius" src={{url(empty($loginUser->icon)?'/home/image/default.jpg':$loginUser->icon)}} width="60" height="60" alt="{{Cookie::get('UserNickname')}}">
							</a>
						</div>
					</div>
					<div class="WB_innerwrap">
						<div class="nameBox">
							<a href="{{url('/home/user/index')}}" class="name S_txt1" title="{{Cookie::get('UserNickname')}}">{{Cookie::get('UserNickname')}}</a>
							<a title="微博会员" target="_blank" href="">
								<i class="W_icon icon_member_dis" style="background-image:url({{url('/home/icon.png')}})"></i>
							</a>
							<a target="_blank" href="">
								@if($level->level > 0)
									<span class="W_icon_level icon_level_c2">
										<span class="txt_out">
											<span class="txt_in">
												<span title="微博等级{{$level->level}} 升级有好礼">Lv.{{$level->level}}</span>
											</span>
										</span>
									</span>
								@else
									<span class="W_icon_level" style="width: 55px;">
										<span class="txt_out">
											<span class="txt_in">
												<span title="全名公敌">全名公敌</span>
											</span>
										</span>
									</span>
								@endif
							</a>
						</div>
						<ul class="user_atten clearfix W_f18">
							<li class="S_line1">
								<a href="{{url('/home/user/fans/'.Hashids::encode(Cookie::get('UserId')))}}" class="S_txt1">
									<strong><?= $fansed ?></strong>
									<span class="S_txt2">关注</span>
								</a>
							</li>
							<li class="S_line1">
								<a href="{{url('/home/user/fansed/'.Hashids::encode(Cookie::get('UserId')))}}" class="S_txt1">
									<strong><?= $fans ?></strong>
									<span class="S_txt2">粉丝</span>
								</a>
							</li>
							<li class="S_line1">
								<a href="" class="S_txt1">
									<strong>31</strong>
									<span class="S_txt2">微博</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	@endif
	<div id="v6_pl_rightmod_companyverifiedtips">
	</div>
	<div id="v6_pl_rightmod_hongbao"></div>
	<div id="v6_pl_rightmod_rank">
		<div class="WB_cardwrap S_bg2">
			<div class="PCD_pictext_g">
				<div class="WB_cardtitle_b S_line2">
					<h4 class="obj_name">
						<span class="main_title W_fb W_f14">
							<a href="" target="_blank" class="S_txt1">{{$weather['date_y']}}天气</a>
						</span>
					</h4>
				</div>
				<div class="WB_innerwrap">
					<div class="m_wrap">
						<div class="list_box">
							<ul class="pt_ul">
								<li class="item SW_fun_bg  clearfix show">
									<div class="li_box S_line2">
										<div class="pic_box">
											<a href="" target="_blank">{{$weather['temperature']}}</a>
										</div>
										<div class="info_box">
											<div class="text_box">
												<a href="" class="title S_txt1 W_autocut">{{$weather['weather']}}</a>
												<div class="subtitle S_txt2 W_autocut">{{$weather['city']}}</div>
												<div class="subtitle S_txt2 W_autocut">
												</div>
											</div>
										</div>
									</div>
								</li>
								<li class="item SW_fun_bg S_line2 clearfix">
									<div class="li_box S_line2">
										<div class="pic_box">
										</div>
										<div class="info_box">
											<div class="text_box">
											</div>
										</div>
									</div>
								</li>
								<li class="item SW_fun_bg S_line2 clearfix">
									<div class="li_box S_line2">
										<div class="pic_box">

										</div>
										<div class="info_box">
											<div class="text_box">
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<a href="" target="_blank" class="WB_cardmore S_txt1 S_line1 clearfix">
					<span class="more_txt">查看更多
						<em class="W_ficon ficon_arrow_right S_ficon"> ></em>
					</span>
				</a>
			</div>
		</div>
	</div>
	<div id="v6_pl_rightmod_recominfo"><!-- notice -->
		<div id="v6_pl_rightmod_ads35">
			<div>
				<div class="WB_cardwrap S_bg2">
					@foreach($advert as $v)
						<a href="http://{{$v->url}}"><img style="margin-bottom:5px;" src="/image/advert/167_{{$v->src}}" alt="{{$v->name}}"></a>
					@endforeach
				</div>
			</div>
		</div>
		<div style="visibility: hidden;"></div>
		<div style="z-index: 10; transform: translateZ(0px); position: relative; transition: margin-top 0.3s ease; will-change: margin-top, top;">
			<div class="WB_cardwrap S_bg2">
				<div class="WB_right_module">
					<div class="WB_cardtitle_b S_line2">
						<h4 class="obj_name">
							<span class="main_title W_fb W_f14">
								<a href="" target="_blank" class="S_txt1">热门话题</a>
							</span>
						</h4>
						<div class="opt_box">
							<a href="javascript:void(0);" class="opt_change S_txt1">
								<span class="glyphicon glyphicon-repeat bg1 right"></span>
							</a>
						</div>
					</div>
					<div class="WB_innerwrap">
						<div id="topicAD" class="m_wrap clearfix"></div>
						<div class="m_wrap clearfix">
							<ul class="hot_topic">
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">2.1亿</span>
										<a target="_blank" class="S_txt1" href="" title="#美联航强制乘客下机#">
											#美联航强制乘客下机#
										</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">1.2亿</span>
										<a target="_blank" class="S_txt1" href="" title="#811绣春刀修罗战场#">
											#811绣春刀修罗战场#
										</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">227万</span>
										<a target="_blank" class="S_txt1" href="" title="#sdgs你问我答#">#sdgs你问我答#</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">2.1亿</span>
										<a target="_blank" class="S_txt1" href="" title="#美联航强制乘客下机#">
											#美联航强制乘客下机#
										</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">1.2亿</span>
										<a target="_blank" class="S_txt1" href="" title="#811绣春刀修罗战场#">
											#811绣春刀修罗战场#
										</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">227万</span>
										<a target="_blank" class="S_txt1" href="" title="#sdgs你问我答#">#sdgs你问我答#</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">2.1亿</span>
										<a target="_blank" class="S_txt1" href="" title="#美联航强制乘客下机#">
											#美联航强制乘客下机#
										</a>
									</p>
								</li>
								<li>
									<p>
										<span class="total S_txt2" title="阅读量">1.2亿</span>
										<a target="_blank" class="S_txt1" href="" title="#811绣春刀修罗战场#">
											#811绣春刀修罗战场#
										</a>
									</p>
								</li>
							</ul>
						</div>
						<div id="topicADButtom" class="m_wrap hot_topic_last clearfix"></div>
					</div>
					<a href="" target="_blank" class="WB_cardmore S_txt1 S_line1 clearfix">
						<span class="more_txt">查看更多
							<em class="W_ficon ficon_arrow_right S_ficon"> ></em>
						</span>
					</a>
				</div>
			</div>
			<div style="height:1px;margin-top:-1px;visibility:hidden;"></div>
		</div>
	</div>
	<div id="v6_pl_rightmod_ads36">
		<div></div>
	</div>
	<div id="v6_pl_rightmod_attfeed">
		<div style="visibility: hidden;"></div>
		<div style="z-index: 10; transform: translateZ(0px); position: relative; transition: margin-top 0.3s ease; will-change: margin-top, top;">
			<div class="WB_cardwrap S_bg2">
				<div class="WB_right_module">
					<div class="WB_cardtitle_b S_line2">
						<h4 class="obj_name">
							<span class="main_title W_fb W_f14">推荐距友</span>
						</h4>
					</div>
					<?php
					$user = DB::select('SELECT * FROM homeuser  ORDER BY  RAND() LIMIT 4');
					for ($i = 0;$i < 4;$i++){
						$userInfo[$i] = DB::select('SELECT * FROM homeuserinfo WHERE uid='.$user[$i]->id)[0];
							}
					?>
				@for($j = 0;$j < 4;$j++)
					@if($user[$j]->name != Cookie::get('UserNickname'))
					<div>
						{{--<div class="WB_cardtitle_d">--}}
							{{--一起走进设计师的世界      </div>--}}
						<div class="WB_innerwrap S_bg1">
							<div class="m_wrap clearfix">
								<div class="friends_dynamic">
									<ul class="group_list">
										<li class="S_line1">
											<div class="pic">
												<a target="_blank" href="{{url('/home/user/'.Hashids::encode($user[$j]->id))}}">
													<img src={{url(empty($userInfo[$j]->icon)?'/home/image/default.jpg':$userInfo[$j]->icon)}} width="30" height="30" alt="">
												</a>
											</div>
												<div class="con">
													<p class="name">
														<a target="_blank" href="{{url('/home/user/'.Hashids::encode($user[$j]->id))}}" class="W_name"><?= $user[$j]->name ?></a>
														<a target="_blank" href="{{url('/home/user/'.Hashids::encode($user[$j]->id))}}">
															<i title="微博个人认证 " class="W_icon icon_approve"></i>
														</a>
													</p>
													<div class="info S_txt2 W_autocut">
														<?= $userInfo[$j]->signature ?>
													</div>
													<div class="opt_m">
														<a href="javascript:void(0);" class="W_btn_b" onclick="addFans(this)" type="button">
															<em class="W_ficon ficon_add">+</em>
															<span>关注</span>
														</a>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						@endif
					@endfor

					<div style="display:none;">
					</div>
					<a href="" class="WB_cardmore S_txt1 S_line1 clearfix">
						<span class="more_txt">
							查看更多<em class="W_ficon ficon_arrow_right S_ficon"> ></em>
						</span>
					</a>
				</div>
			</div>
			<div style="height:1px;margin-top:-1px;visibility:hidden;"></div>
		</div>
	</div>
	<div id="v6_pl_rightmod_noticeboard">
		<div class="WB_cardwrap S_bg2">
			<div class="WB_right_module">
				<div class="Back_mod">
					<div class="WB_cardtitle_b S_line2">
						<h4 class="obj_name">
							<span class="main_title W_fb W_f14">公告栏</span>
						</h4>
					</div>
					<div class="WB_innerwrap">
						<ul class="opinion_type_list">
							<a>{{$announcement}}</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="v6_pl_ad_bigday">
		<input type="hidden">
	</div>
	<div id="v6_pl_ad_forfqy">
		<span>
			<input type="hidden">
		</span>
	</div>
</div>

{{--关注成功弹窗--}}
<div style="display: none" class="out_biv"></div>
<div class="W_layer " style="display: none">
	<div tabindex="0"></div>
	<div class="content">
		<div class="W_layer_title">Wejoy微距</div>
		<div class="W_layer_close">
			<a href="javascript:void(0);" class="W_ficon ficon_close S_ficon" onclick="closediv()">X</a>
		</div>
		<div class="W_layer_content">
			<div class="fans_status">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<span class="fans_status_span">关注成功</span>
			</div>
			<div class="ficon_close_div">
				<a href="javascript:void(0)" class="btn btn-warning ficon_close" onclick="closediv()">确定</a>
			</div>
		</div>
	</div>
</div>
{{--忘记密码弹窗--}}
<div class="W_layer_makemm W_layer" style="display: none">
	<div tabindex="0"></div>
	<div class="content">
		<div class="W_layer_title">Wejoy微距</div>
		<div class="W_layer_close">
			<a href="javascript:void(0);" class="W_ficon ficon_close S_ficon" onclick="closediv()">X</a>
		</div>
		<div class="W_layer_content">
			<div class="fans_status">
				<form style="margin: 20px;text-align: left" id="ResetPwd_form">
					<div class="form-group">
						{{csrf_field()}}
						<label for="exampleInputName">输入您的用户名</label>
						<input type="email" class="form-control" id="exampleInputName" placeholder="NickName" name="name">
					</div>
					<di><span style="color: red">我们将通过您之前设置的邮箱为你重置密码 <br>(注意：重置后密码为123456，请自行到用户中心修改)</span></di>
				</form>
			</div>
			<div class="ficon_close_div">
				<a href="javascript:void(0)" class="btn btn-warning ficon_close" onclick="doResetPwd()">确定</a>
			</div>
		</div>
	</div>
</div>
