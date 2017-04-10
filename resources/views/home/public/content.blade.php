<div class="box-content" style="float:left;width:622px;height:300px;margin-right:50px;">
  <ul style="list-style:none;">
    <li class="panel panel-default" style="height:183px;padding:10px;">
      <br>
      &nbsp;&nbsp;&nbsp;有什么新鲜事想告诉大家?
        <div class="cont-box">
          <textarea class="text" placeholder="请输入..."></textarea>
        </div>
        <div class="tools-box">
          <div class="operator-box-btn"><span class="face-icon"  >☺</span><span class="img-icon">▧</span></div>
          <div class="submit-btn"><input type="button" onClick="out()"value="提交评论" /></div>
        </div>
        <div id="info-show">
    			<ul></ul>
    		</div>
    </li>
    <li class="panel panel-default" style="height:300px;"></li>
    <li class="panel panel-default" style="height:300px;"></li>
    <li class="panel panel-default" style="height:300px;"></li>
    <li class="panel panel-default" style="height:300px;"></li>
    <li class="panel panel-default" style="height:300px;"></li>
  </ul>
</div>

<script type="text/javascript">
	// 绑定表情
	$('.face-icon').SinaEmotion($('.text'));
	// 测试本地解析
	function out() {
		var inputText = $('.text').val();
		$('#info-show ul').append(reply(AnalyticEmotion(inputText)));
	}

	var html;
	function reply(content){
		html  = '<li>';
		html += '<div class="head-face">';
		html += '<img src="images/1.jpg" / >';
		html += '</div>';
		html += '<div class="reply-cont">';
		html += '<p class="username">小小红色飞机</p>';
		html += '<p class="comment-body">'+content+'</p>';
		html += '<p class="comment-footer">2016年10月5日　回复　点赞54　转发12</p>';
		html += '</div>';
		html += '</li>';
		return html;
	}
</script>
