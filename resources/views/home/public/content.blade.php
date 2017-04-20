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
