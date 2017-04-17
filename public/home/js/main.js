(function($) {
    $.fn.extend({
        insertContent: function(myValue, t) {
            var $t = $(this)[0];
            if (document.selection) { //ie
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
                sel.moveStart('character', -l);
                var wee = sel.text.length;
                if (arguments.length == 2) {
                    var l = $t.value.length;
                    sel.moveEnd("character", wee + t);
                    t <= 0 ? sel.moveStart("character", wee - 2 * t - myValue.length) : sel.moveStart("character", wee - t - myValue.length);

                    sel.select();
                }
            } else if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
                if (arguments.length == 2) {
                    $t.setSelectionRange(startPos - t, $t.selectionEnd + t);
                    this.focus();
                }
            }
            else {
                this.value += myValue;
                this.focus();
            }
        }
    })
})(jQuery);

$(document).ready(function(){
	$(".img-icon").live('click',function(){
		$(".cont-box .text").insertContent('<img src="请在这里输入图片地址" alt=""/>', -10);
	});
  $('#issue').live('click',function(){
    var contents = {
      _token : $('#testform').children('input').val(),
      content : $('#textarea').val()
    }
    $.ajax({
      type:'post',
      data:contents,
      url:'content',
      success:function(data){
        console.log(data);
        var newcontent = '';
        newcontent += "<li class='panel panel-default boxtest'><div><div class='Wejoy_feed_detail clearfix'><div class='Wejoy_face bg2'></div><div class='Wejoy_detail'><div class='WJ_info clearfix'>";
        newcontent += "<span class='left'>"+$('.name').attr('title')+"</span>";
        newcontent += "<div class='dropdown'> <a class='right dropdown-toggle Wj_cursons' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span class='glyphicon glyphicon-chevron-down'></span> </a><ul class='dropdown-menu WJ-menu-right dropdown-menu-right' aria-labelledby='dropdownMenu1'>";
        newcontent += "<li><a href='#'>帮上头条</a></li><li><a href='#'>屏蔽这条微博</a></li><li><a href='#'>屏蔽该用户</a></li><li><a href='#'>取消关注该用户</a></li> <li role='separator' class='divider'></li><li><a href='#'>举报</a></li></ul></div></div>";
        newcontent += "<div class='WJ_text clearfix'>"+data.created_at+" 来自 微博 weibo.com</div>";
        newcontent += "<div class='WJ_text2 clearfix'>"+data.content+"</div>";
        newcontent += "<div class='Wj_media_wrap clearfix bg2'></div></div></div>";
        newcontent += "<div class='WJ_feed_handle clearfix'><ul class='WJ_row_line row'>";
        newcontent += "<li class='left'><span class='glyphicon glyphicon-star-empty pos' >收藏</span></li>";
        newcontent += "<li class='left'><span class='glyphicon glyphicon-share' > "+data.transmits+"</span></li>";
        newcontent += "<li class='left'><span id='"+data.id+"' class='glyphicon glyphicon-comment comshow' > "+data.comments+"</span></li>";
        newcontent += "<li class='left'><span class='glyphicon glyphicon-thumbs-up' > "+data.favtimes+"</span></li>";
        newcontent += "</ul></div><div class='E_feed_publish con"+data.id+" clearfix'></div></li></div></li>";
        $('.boxtest:first').after(newcontent);
        // 解析表情
        $(".WJ_text2").emojiParse({
          icons: [{
              path: "/home/image/tieba/",
              file: ".jpg",
              placeholder: ":{alias}:",
              alias: {
                  1: "hehe",
                  2: "haha",
                  3: "tushe",
                  4: "a",
                  5: "ku",
                  6: "lu",
                  7: "kaixin",
                  8: "han",
                  9: "lei",
                  10: "heixian",
                  11: "bishi",
                  12: "bugaoxing",
                  13: "zhenbang",
                  14: "qian",
                  15: "yiwen",
                  16: "yinxian",
                  17: "tu",
                  18: "yi",
                  19: "weiqu",
                  20: "huaxin",
                  21: "hu",
                  22: "xiaonian",
                  23: "neng",
                  24: "taikaixin",
                  25: "huaji",
                  26: "mianqiang",
                  27: "kuanghan",
                  28: "guai",
                  29: "shuijiao",
                  30: "jinku",
                  31: "shengqi",
                  32: "jinya",
                  33: "pen",
                  34: "aixin",
                  35: "xinsui",
                  36: "meigui",
                  37: "liwu",
                  38: "caihong",
                  39: "xxyl",
                  40: "taiyang",
                  41: "qianbi",
                  42: "dnegpao",
                  43: "chabei",
                  44: "dangao",
                  45: "yinyue",
                  46: "haha2",
                  47: "shenli",
                  48: "damuzhi",
                  49: "ruo",
                  50: "OK"
              }
          }, {
              path: "/home/image/qq/",
              file: ".gif",
              placeholder: "#qq_{alias}#"
          }]
        });
        toastr.success('发布微博成功');
      },
      error:function(data){
        console.log(data);
        toastr.error('发布微博失败');
      }
    });
  });
});
