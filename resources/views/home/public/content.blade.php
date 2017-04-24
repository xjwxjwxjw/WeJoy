	<div class="box-content clearfix" id="box-content" style="float:left;position: relative;">
	<div id="imloading" class="well well-sm" style=" text-align: center;background:#f2dede;display:none;" >I'm Loading...</div>
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
	          <div class="operator-box-btn">
							<span id="img-icon" class="img-icon">▧</span>
							<div id="zyupload" style="display:none;" class="zyupload"></div>
							<div class="comtype left" style="height:24px;margin-left:10px;">
								<select class="form-control" style="height:30px;">
									<option selected="selected">分享趣事</option>
									@foreach( $newtype as $v )
											<option>{{$v}}</option>
									@endforeach
								</select>
							</div>
						</div>
	          <div class="submit-btn"><input id="issue" disabled=true type="button" class="bgsmred" value="发布">
	          </div>
	        </div>
          </form>
	    </li>
			@if(empty($news))
			无数据
			@else
			@foreach ($news as $new)
			<li id='li{{$new->hid}}' class='panel panel-default boxtest'><div><div class='Wejoy_feed_detail clearfix'><a href='/home/user/{{$new->uid}}'><div class='Wejoy_face'><img src='/{{$new->usericon}}' alt=''></div></a><div class='Wejoy_detail'><div class='WJ_info clearfix'>
			<span class='left'><a href='/home/user/{{$new->uid}}'>{{$new->username}}</a></span>
			<div class='dropdown'> <a class='right dropdown-toggle Wj_cursons' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span class='glyphicon glyphicon-chevron-down'></span> </a><ul class='dropdown-menu WJ-menu-right dropdown-menu-right' aria-labelledby='dropdownMenu1'>
			@if( $new->uid == $new->bid )
				<li id='comdel{{$new->hid}}' class='commentdel'><a href='#' >删除</a></li><li><a href='#'>帮上头条</a></li><li><a href='#'>屏蔽这条微博</a></li><li><a href='#'>屏蔽该用户</a></li><li><a href='#'>取消关注该用户</a></li> <li role='separator' class='divider'></li><li><a href='#'>举报</a></li></ul></div></div>
			@else
				<li><a href=''>帮上头条</a></li><li><a href=''>屏蔽这条微博</a></li><li><a href='#'>屏蔽该用户</a></li><li><a href='#'>取消关注该用户</a></li> <li role='separator' class='divider'></li><li><a href='#'>举报</a></li></ul></div></div>
			@endif
			<div class='WJ_text clearfix'>{{$new->created_at}} 来自 微博 weibo.com</div>
			<div class='WJ_text2 clearfix'>{{$new->content}}</div>
				<div class='Wj_media_wrap clearfix'>
					<div class='Wj_media_wrap_ul clearfix'>
						@if(count($new->images) <=0 )

						@elseif( count($new->images) > 1  )
						@foreach( $new->images as $v )
						<?php $img = substr_replace($v,'110_',17,0) ?>
						<img src="/{{$img}}" alt="">
						@endforeach
						@else
						<?php $url = substr_replace($new->images[0],'167_',17,0) ?>
						<img src="/{{$url}}" alt="">
						@endif
					</div>
				</div></div></div>
			<div class='WJ_feed_handle clearfix'><ul class='WJ_row_line row'>

					@if( in_array($new->hid,$mycollect ) )
						<li class='left'><span id='pos{{$new->hid}}' class='glyphicon glyphicon-star-empty bgorigin posdie' >已收藏</span></li>
					@else
						<li class='left'><span id='pos{{$new->hid}}' class='glyphicon glyphicon-star-empty pos' >收藏</span></li>
					@endif

					<li class='left'><span class='glyphicon glyphicon-share' > {{$new->transmits}}</span></li>
					<li class='left'><span id='{{$new->hid}}' class='glyphicon glyphicon-comment comshow' > {{$new->countcom}}</span></li>
					@if( in_array($new->hid,$myfavtimes ) )
						<li class='left'><span id='good{{$new->hid}}' class='glyphicon glyphicon-thumbs-up good bgorigin gooddie' > {{$new->favtimes}}</span></li>
					@else
					<li class='left'><span id='good{{$new->hid}}' class='glyphicon glyphicon-thumbs-up good' > {{$new->favtimes}}</span></li>
					@endif

			</ul></div><div class='WE_feed_publish con{{$new->hid}} clearfix'></div></li>
			@endforeach
			@endif
	  </ul>
	</div>

	<!-- Large modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">添加权限</h4>
				</div>
				<div class="modal-body">
					<form action=''  method="post" id="testform">
						{{csrf_field()}}
						<div class="form-group">
							<label for="recipient-name" class="control-label">权限路由：</label>
							<input type="text" class="form-control" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="message-text" class="control-label" >权限描述：</label>
							<textarea class="form-control" name="display_name" id="content"></textarea>
						</div>
						<div class="form-group">
							<label for="message-text" class="control-label" >描述：</label>
							<textarea class="form-control" name="description" id="content2"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="btn" >Send message</button>
				</div>
			</div>
		</div>
	</div>
