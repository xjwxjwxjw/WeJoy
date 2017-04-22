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
						</div>
	          <div class="submit-btn"><input id="issue" disabled=true type="button" class="bgsmred" value="发布">
	          </div>
	        </div>
          </form>
	    </li>
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
