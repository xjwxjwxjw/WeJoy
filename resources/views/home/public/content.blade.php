<script src={{url("home/js/wejoymasonry.js")}}></script>
	<div class="box-content clearfix" id="box-content" style="float:left;position: relative;">
	<div id="imloading" class="well well-sm" style=" text-align: center;background:#f2dede;display:none;" >I'm Loading...</div>
	  <ul style="list-style:none;" id="test">
			@if( Cookie::has('UserId') )
	    <li id="comttset" class="panel panel-default boxtest" style="height:165px;padding:10px;">
	      &nbsp;&nbsp;&nbsp;有什么新鲜事想告诉大家?

        <div style="float:right;" id="result">可输入150字</div>
        <form id="testform" action="" method="post">
          {{csrf_field()}}
	        <div class="cont-box" id="cont-box" >
              <textarea  id="textarea" oninput="" onpropertychange="" class="text" placeholder="请输入..."></textarea>
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
							<div class="">
								<a id="city" style="line-height:30px;cursor: pointer;margin-left:5px;"><span class="glyphicon glyphicon-map-marker"></span>{{$city}}</a>
							</div>
						</div>
	          <div class="submit-btn"><input id="issue" disabled=true type="button" class="bgsmred" value="发布">
	          </div>
	        </div>
          </form>
			@else
			@endif
		</li>
			@if(empty($news))
				无数据
			@else
			@foreach ($news as $new)
			<!-- 正常样式 -->
			<li id='li{{$new->hid}}' class='panel panel-default boxtest'><div><div class='Wejoy_feed_detail clearfix'><a href='/home/user/{{$new->uid}}'><div class='Wejoy_face'><img src={{url(empty($new->usericon)?'/home/image/default.jpg':$new->usericon)}} alt=''></div></a><div class='Wejoy_detail'><div class='WJ_info clearfix'>
			<span class='left'><a href='/home/user/{{$new->uid}}'>{{$new->username}}</a></span>
			<div class='dropdown'> <a class='right dropdown-toggle Wj_cursons' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span class='glyphicon glyphicon-chevron-down'></span> </a><ul class='dropdown-menu WJ-menu-right dropdown-menu-right' aria-labelledby='dropdownMenu1'>
			@if( $new->uid == $new->bid )
				<li id='comdel{{$new->hid}}' class='commentdel'><a href='#' >删除</a></li><li role='separator' class='divider'></li><li><a href='#'>功能扩展中</a></li></ul></div></div>
			@else
				<li role='separator' class='divider'></li><li><a href='#'>功能扩展中</a></li></ul></div></div>
			@endif
			<div class='WJ_text clearfix'>{{$new->created_at}} <span class="glyphicon glyphicon-map-marker">{{$new->city}}</span></div>
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
				@if( $new->transmits != -1 )
						<div class="trabg">
							<div class="WJ_info clearfix"><a href='/home/user/{{$new->trauid}}'>@ {{$new->traname}}</a></div>
							<div class='WJ_text2 clearfix'>{{$new->tracon}}</div>
							@if(count($new->traimages) <=0 )
							@elseif( count($new->traimages) > 1  )
							<div class="WJ_traimg">
							@foreach( $new->traimages as $va )
							<?php $img = substr_replace($va,'110_',17,0) ?>
								<img src="/{{$img}}" alt="">
							@endforeach
							@else
							<?php $url = substr_replace($new->traimages[0],'167_',17,0) ?>
								<img src="/{{$url}}" alt="">
							@endif
						</div>
						</div>
				@endif
			<div class='WJ_feed_handle clearfix'><ul class='WJ_row_line row'>
				@if( Cookie::has('UserId') )
					@if( in_array($new->hid,$mycollect ) )
						<li class='left'><span id='pos{{$new->hid}}' class='glyphicon glyphicon-star-empty bgorigin posdie' >已收藏</span></li>
					@else
						<li class='left'><span id='pos{{$new->hid}}' class='glyphicon glyphicon-star-empty pos' >收藏</span></li>
					@endif
					<li class='left'><span id='share{{$new->hid}}' target="_blank" data-toggle="modal" data-target="#aModals" class='glyphicon glyphicon-share' > </span></li>
					<li class='left'><span id='{{$new->hid}}' class='glyphicon glyphicon-comment comshow' > {{$new->countcom}}</span></li>
					@if( in_array($new->hid,$myfavtimes ) )
						<li class='left'><span id='good{{$new->hid}}' class='glyphicon glyphicon-thumbs-up good bgorigin gooddie' > {{$new->favtimes}}</span></li>
					@else
					<li class='left'><span id='good{{$new->hid}}' class='glyphicon glyphicon-thumbs-up good' > {{$new->favtimes}}</span></li>
					@endif
				@else
				@endif
			</ul></div><div class='WE_feed_publish con{{$new->hid}} clearfix'></div></li>
			@endforeach
			@endif
	  </ul>
	</div>
	<!-- Large modal -->
	<div class="modal fade" id="aModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">转发微博</h4>
	      </div>
	      <div class="modal-body">
	        <form action='' name=""  method="post" id="traform" enctype="multipart/form-data" >
	          {{csrf_field()}}
	          <div class="form-group">
	            <label for="recipient-name" class="control-label">内容：</label>
	            <input type="text" class="form-control" name="name" id="name">
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" id="btns" class="btn btn-default" value="Send message">
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- </div> -->
