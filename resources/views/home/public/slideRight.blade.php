<div class="WB_main_r">
	<div id="v6_pl_content_setskin">
		{{--此处div为右侧改背景按钮--}}
		<div class="templete_enter UI_top_hidden">
			<a href="javascript:void(0);" class="W_icon icon_setskin" title="模板设置"></a>
		</div>
	</div>
	{{--判断 如果登陆则显示头像 否则显示登陆界面--}}
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
				<!--<div class="info_list pre_info clearfix" node-type="prename_box" style="display:none"></div>-->
				<div class="info_list username">
					<div class="input_wrap">
						<input id="loginname" type="text" class="W_input" maxlength="128" autocomplete="off" name="username" tabindex="1" placeholder="手机/邮箱/用户名">
					</div>
				</div>
				<div class="info_list password">
					<div class="input_wrap">
						<input type="password" type="password" class="W_input" maxlength="24" autocomplete="off" value="" tabindex="2" placeholder="请输入密码">
					</div>
				</div>
				<!-- 输入验证码 -->
				<div class="info_list verify clearfix" style="display: none">
					<div class="input_wrap W_fl">
						<input type="text" class="W_input" maxlength="6" autocomplete="off" value="" name="verifycode" tabindex="3" placeholder="验证码">
					</div>
					<a class="code W_fl" onclick="return false;" href="javascript:void(0);">
						<img width="90" height="34" src="about:blank">
					</a>
				</div>
				<!-- /输入验证码 -->
				<div class="info_list auto_login clearfix">
					<div class="right W_fr">
						<a href="javascript:void(0);" onclick="var loginname=document.getElementById('loginname').value;window.open('https://security.weibo.com/iforgot/loginname?entry=weibo&amp;loginname='+loginname);" class="S_txt2">忘记密码</a>
					</div>
					<label for="login_form_savestate" class="W_fl W_label" title="建议在网吧或公共电脑上取消该选项。">
						<input type="checkbox" id="login_form_savestate" checked="checked" tabindex="5" class="W_checkbox">
						<span class="S_txt2">记住我</span>
					</label>
				</div>
				<div class="info_list login_btn">
					<a href="javascript:void(0)" class="W_btn_a btn_32px" tabindex="6">
						<span>登录</span>
					</a>
				</div>
				<div class="info_list register">
					<span class="S_txt2">还没有微博？</span>
					<a target="_blank" href="">立即注册!</a>
				</div>
			</div>
			<!-- 短信登陆 -->
			<div class="W_login_form" style="display: none;">
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
					<a target="_blank" href="">立即注册!</a>
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
	{{--个人信息--}}
	<div id="v6_pl_rightmod_myinfo" style="display: none">
		<div class="WB_cardwrap S_bg2">
			<div class="W_person_info">
				<div class="cover" id="skin_cover_s" style="background-image:url({{url('/home/bg.jpg')}});background-size:100% 100%;">
					<div class="headpic">
						<a href="" title="名字">
							<img class="W_face_radius" src={{url('home/1.jpg')}} width="60" height="60" alt="名字">
						</a>
					</div>
				</div>
				<div class="WB_innerwrap">
					<div class="nameBox">
						@if(Auth::check())
							<a href="" class="name S_txt1" title="名字">{{Auth::user()->username}}</a>
							@else
							<a href="" class="name S_txt1" title="名字">名字</a>
							@endif
						<a title="微博会员" target="_blank" href="">
							<i class="W_icon icon_member_dis" style="background-image:url({{url('/home/icon.png')}})"></i>
						</a>
						<a target="_blank" href="">
							<span class="W_icon_level icon_level_c2">
								<span class="txt_out">
									<span class="txt_in">
										<span title="微博等级4 升级有好礼">Lv.4</span>
									</span>
								</span>
							</span>
						</a>
					</div>
					<ul class="user_atten clearfix W_f18">
						<li class="S_line1">
							<a href="" class="S_txt1">
								<strong>23</strong>
								<span class="S_txt2">关注</span>
							</a>
						</li>
						<li class="S_line1">
							<a href="" class="S_txt1">
								<strong>32</strong>
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
	<div id="v6_pl_rightmod_companyverifiedtips">
	</div>
	<div id="v6_pl_rightmod_hongbao"></div>
	<div id="v6_pl_rightmod_rank">
		<div class="WB_cardwrap S_bg2">
			<div class="PCD_pictext_g">
				<div class="WB_cardtitle_b S_line2">
					<h4 class="obj_name">
						<span class="main_title W_fb W_f14">
							<a href="" target="_blank" class="S_txt1">微博电影想看榜</a>
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
											<a href="" target="_blank">
												<img src="" alt="速度与激情8" class="pic">
											</a>
										</div>
										<div class="info_box">
											<div class="text_box">
												<a href="" class="title S_txt1 W_autocut" title="速度与激情8" target="_blank">
													<i class="icon_num_red">1</i>
													速度与激情8
												</a>
												<div class="subtitle S_txt2 W_autocut">导演：F·加里·格雷</div>
												<div class="subtitle S_txt2 W_autocut">
													主演：范·迪塞尔 / 道恩·强森 / 杰森·斯坦森 / 米歇尔·罗德里格兹（Michelle
												</div>
												<div class="subtext S_txt2">98.1</div>
											</div>
										</div>
									</div>
								</li>
								<li class="item SW_fun_bg S_line2 clearfix">
									<div class="li_box S_line2">
										<div class="pic_box">
											<a href="" target="_blank">
												<img src="" alt="傲娇与偏见" class="pic">
											</a>
										</div>
										<div class="info_box">
											<div class="text_box">
												<a href="" class="title S_txt1 W_autocut" title="傲娇与偏见" target="_blank">
													<i class="icon_num_yellow">2</i>
													傲娇与偏见
												</a>
												<div class="subtitle S_txt2 W_autocut">导演：李海蜀 / 黄彦威</div>
												<div class="subtitle S_txt2 W_autocut">
													主演：迪丽热巴·迪力木拉提 / 张云龙 / 高伟光 / 金晨 / 马薇薇 / 范湉湉
												</div>
												<div class="subtext S_txt2">95.9</div>
											</div>
										</div>
									</div>
								</li>
								<li class="item SW_fun_bg S_line2 clearfix">
									<div class="li_box S_line2">
										<div class="pic_box">
											<a href="" target="_blank">
												<img src="" alt="傲娇与偏见" class="pic">
											</a>
										</div>
										<div class="info_box">
											<div class="text_box">
												<a href="" class="title S_txt1 W_autocut" title="傲娇与偏见" target="_blank">
													<i class="icon_num_yellow">2</i>
													傲娇与偏见
												</a>
												<div class="subtitle S_txt2 W_autocut">导演：李海蜀 / 黄彦威</div>
												<div class="subtitle S_txt2 W_autocut">
													主演：迪丽热巴·迪力木拉提 / 张云龙 / 高伟光 / 金晨 / 马薇薇 / 范湉湉
												</div>
												<div class="subtext S_txt2">95.9</div>
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
					<div class="WB_right_module M_sc_right">
						<div class="WB_innerwrap">
							<div class="m_wrap">
								<div class="scr_iframe_wrap">
									<iframe id="sc_37694" src="" width="186" height="250" frameborder="0" scrolling="no">

									</iframe>广告
								</div>
							</div>
						</div>
					</div>
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
							<span class="main_title W_fb W_f14">好友关注动态</span>
						</h4>
					</div>
					<div>
						<div class="WB_cardtitle_d">
							<a href="" class="W_autocut">@每日笑话微博</a>等64万人关注了
						</div>
						<div class="WB_innerwrap S_bg1">
							<div class="m_wrap clearfix">
								<div class="friends_dynamic">
									<ul class="group_list">
										<li class="S_line1">
											<div class="pic">
												<a target="_blank" href="">
													<img src="" width="30" height="30" alt="">
												</a>
											</div>
											<div class="con">
												<p class="name">
													<a target="_blank" href="">逗比小学弟</a>
													<a target="_blank" href="">
														<i title="微博个人认证 " class="W_icon icon_approve_gold" style="background-image: url({{url('/home/icon.png')}});"></i>
													</a>
												</p>
												<div class="info S_txt2 W_autocut">微博知名搞笑幽默帐号</div>
												<div class="opt_m">
													<a href="javascript:void(0);" class="W_btn_b">
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
					<div>
						<div class="WB_cardtitle_d">
							一起走进设计师的世界      </div>
						<div class="WB_innerwrap S_bg1">
							<div class="m_wrap clearfix">
								<div class="friends_dynamic">
									<ul class="group_list">
										<li class="S_line1">
											<div class="pic">
												<a target="_blank" href="">
													<img src="" width="30" height="30" alt="">
												</a>
											</div>
											<div class="con">
												<p class="name">
													<a target="_blank" href="">ide0007</a>
													<a target="_blank" href="">
														<i title="微博个人认证 " class="W_icon icon_approve"></i>
													</a>
												</p>
												<div class="info S_txt2 W_autocut">
													北京红缨教育集团高级平面设计师 微博头条文章作者
												</div>
												<div class="opt_m">
													<a href="javascript:void(0);" class="W_btn_b">
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
					<div>
						<div class="WB_cardtitle_d">
							<a href="" class="W_autocut">@每日笑话微博</a>等64万人关注了
						</div>
						<div class="WB_innerwrap S_bg1">
							<div class="m_wrap clearfix">
								<div class="friends_dynamic">
									<ul class="group_list">
										<li class="S_line1">
											<div class="pic">
												<a target="_blank" href="">
													<img src="" width="30" height="30" alt="">
												</a>
											</div>
											<div class="con">
												<p class="name">
													<a target="_blank" href="">逗比小学弟</a>
													<a target="_blank" href="">
														<i title="微博个人认证 " class="W_icon icon_approve_gold"></i>
													</a>
												</p>
												<div class="info S_txt2 W_autocut">微博知名搞笑幽默帐号</div>
												<div class="opt_m">
													<a href="javascript:void(0);" class="W_btn_b">
														<em class="W_ficon ficon_add">+</em>关注
													</a>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div class="WB_cardtitle_d">
							一起走进设计师的世界      </div>
						<div class="WB_innerwrap S_bg1">
							<div class="m_wrap clearfix">
								<div class="friends_dynamic">
									<ul class="group_list">
										<li class="S_line1">
											<div class="pic">
												<a target="_blank" href="">
													<img src="" width="30" height="30" alt="">
												</a>
											</div>
											<div class="con">
												<p class="name">
													<a target="_blank" href="">ide0007</a>
													<a target="_blank" href="">
														<i title="微博个人认证 " class="W_icon icon_approve"></i>
													</a>
												</p>
												<div class="info S_txt2 W_autocut">
													北京红缨教育集团高级平面设计师 微博头条文章作者
												</div>
												<div class="opt_m">
													<a href="javascript:void(0);" class="W_btn_b">
														<em class="W_ficon ficon_add">+</em>关注
													</a>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
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
							<li><a href="" target="_blank">《​全国辟谣平台》</a></li>
							<li><a href="" target="_blank">《首都互联网协会发布坚守七条底线倡议书》</a>
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