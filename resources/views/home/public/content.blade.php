	<div class="box-content clearfix" id="box-content" style="float:left;position: relative;">
	<div id="imloading" class="well well-sm" style=" text-align: center;position: absolute;bottom:-60px;width:602px;z-index:999;background:#f2dede;display:none;" >I'm Loading...</div>
	  <ul style="list-style:none;" id="test">
	    <li class="panel panel-default boxtest" style="height:165px;padding:10px;">
	      &nbsp;&nbsp;&nbsp;有什么新鲜事想告诉大家?
        <div style="float:right;" id="result">可输入150字</div>
        <form id="testform" action="" method="post">
          {{csrf_field()}}
	        <div class="cont-box" id="cont-box" >
              <textarea  id="textarea" oninput="" onpropertychange="" class="text" placeholder="请输入..."></textarea
          </div>
	        <div class="tools-box" style="border:0px solid red;position:relative;">
	          <div class="operator-box-btn"><span class="face-icon self_commit"  > </div>
	          <div class="submit-btn"><input id="issue" type="button" class="bgsmred" value="发布">
	          </div>
	        </div>
          </form>
	        <!-- <div id="info-show">
				<ul></ul>
	    	</div> -->
	    </li>
		  <li class='panel panel-default boxtest'>
			<div>
				<div class="Wejoy_feed_detail clearfix">
					<div class="Wejoy_face bg2"></div>
					<div></div>
					<div class="Wejoy_detail">
						<div class="WJ_info clearfix">
							<span class="left"></span>
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
						<div class="WJ_text clearfix"> 来自 微博 weibo.com</div>
						<div class="WJ_text2 clearfix"></div>
						<div class="Wj_media_wrap clearfix bg2"></div>
					</div>
				</div>
				<div class="WJ_feed_handle clearfix">
					<ul class="WJ_row_line row">
						<li class="left"><span class="glyphicon glyphicon-star-empty pos" > 收藏</span></li>
						<li class="left"><span class="glyphicon glyphicon-share" > </span></li>
						<li class="left"><span class="glyphicon glyphicon-comment" > </span></li>
						<li class="left"><span class="glyphicon glyphicon-thumbs-up" > 129</span></li>
					</ul>
				</div>
        <div class="WE_feed_publish clearfix">
          <div class="WE_repeat clearfix">
            <!-- 发布评论 -->
            <div class="WE_feed_comments">
              <div class="WE_publish_face">
                <img src="{{url('/home/1.jpg')}}" alt="">
              </div>
              <div class="WE_publish clearfix">
                <form id="testform" action="" method="post">
              {{csrf_field()}}
    	        <div class="WE_feed_publish_comments" id="cont-box2" >
                  <input type="text" name="comments" id='publishcomments' value="">
              </div>
    	        <div class="tools-box" style="border:0px solid red;">
    	          <div class="operator-box-btn"><span class="face-icon"  >☺</span><span class="img-icon">▧</span></div>
    	          <div class="submit-btn"><input id="docomment" type="button" class="bgsmred" value="评论">
    	          </div>
    	        </div>
              </form>
            </div>
            </div>
            <!-- 评论列表 -->
            <div class="repeat_list">
              <!-- 列表标题 -->
              <div class="tab_feed_a">

              </div>
              <!-- 评论列表内容 -->
              <div class="list_box">
                <!-- 一级评论 -->
                <div class="list_li">
                  <!--评论头像 -->
                  <div class="WE_face">
                    <img src="{{url('/home/1.jpg')}}" alt="">
                  </div>
                  <!-- 评论内容 -->
                  <div class="list-con">
                    <div class="WE_text">
                      <a>温柔大哥</a>
                        : 详情看主页
                    </div>
                    <div class="WE_func clearfix">
                      <div class="WE_time">11分钟前</div>
                      <div class="">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
			</div>
		</li>
	  </ul>
	</div>
