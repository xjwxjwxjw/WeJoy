<style type="text/css">
    body{background-image:url( {{ url('home/image/body_bg.jpg') }} );}
</style>
	<div class="box-content clearfix" id="box-content" style="float:left;position: relative;">
	<div id="imloading" class="well well-sm" style=" text-align: center;position: absolute;bottom:-60px;width:602px;z-index:999;background:#f2dede;display:none;" >I'm Loading...</div>
	  <ul style="list-style:none;" id="test">
	    <li class="panel panel-default boxtest" style="height:165px;padding:10px;">
	      &nbsp;&nbsp;&nbsp;有什么新鲜事想告诉大家?
        <form id="testform" action="" method="post">
          {{csrf_field()}}
	        <div class="cont-box" id="cont-box" >
              <textarea  id="textarea" oninput="" onpropertychange="" class="text" placeholder="请输入..."></textarea
          </div>
	        <div class="tools-box" style="border:0px solid red;">
	          <div class="operator-box-btn"><span class="face-icon"  >☺</span><span class="img-icon">▧</span></div>
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
			</div>
		</li>
	  </ul>
	</div>
