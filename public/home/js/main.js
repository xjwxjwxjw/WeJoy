$(document).ready(function(){
  $('#img-icon').bind('click',function(){
      $('#issue').toggle();
      $('.zyupload').toggle();
  })

  $('.glyphicon-share').live('click',function(){
    $('#myModal').attr('style','display:inline-block');
  })

  $('#img-icon').one('click',function(){
      // 初始化插件
      $("#zyupload").one().zyUpload({
      	width            :   "600px",                 // 宽度
      	height           :   "400px",                 // 宽度
      	itemWidth        :   "140px",                 // 文件项的宽度
      	itemHeight       :   "115px",                 // 文件项的高度
      	url              :   "http://wejoy.cn/home/commentimg",              // 上传文件的路径
      	fileType         :   ["jpg","png"],           // 上传文件的类型
      	fileSize         :   51200000,                // 上传文件的大小
      	multiple         :   true,                    // 是否可以多个文件上传
      	dragDrop         :   true,                    // 是否可以拖动上传文件
      	tailor           :   true,                    // 是否可以裁剪图片
      	del              :   true,                    // 是否可以删除文件
      	finishDel        :   true,  				  // 是否在上传文件完成后删除预览
      	/* 外部获得的回调接口 */
      	onSelect: function(selectFiles, allFiles){    // 选择文件的回调方法  selectFile:当前选中的文件  allFiles:还没上传的全部文件

      	},
      	onDelete: function(file, files){              // 删除一个文件的回调方法 file:当前删除的文件  files:删除之后的文件

      	},
      	onSuccess: function(file, response){          // 文件上传成功的回调方法
          // console.info(file.name);
      	},
      	onFailure: function(file, response){          // 文件上传失败的回调方法

      	},
      	onComplete: function(response){           	  // 上传完成的回调方法
          $('#issue').click();
          $('.zyupload').toggle();
          $('#issue').toggle();
          $('#issue').attr("disabled",true).addClass('bgsmred').removeClass('bgred');
      	}
      });

    });
  $('#issue').live('click',function(){
    var contents = {
      content : $('#textarea').val(),
      topic:$('.form-control option:selected').val()
    }
    $.ajax({
      type:'post',
      data:contents,
      url:'content',
      success:function(data){
        $('#textarea').val('');
        $('#issue').attr("disabled",true).addClass('bgsmred').removeClass('bgred');
        var newcontent = '';
        newcontent += "<li id='li"+data.hid+"' class='panel panel-default boxtest'><div><div class='Wejoy_feed_detail clearfix'><div class='Wejoy_face bg2'><img src='/"+data.usericon+"' alt=''></div><div class='Wejoy_detail'><div class='WJ_info clearfix'>";
        newcontent += "<span class='left'>"+$('.name').attr('title')+"</span>";
        newcontent += "<div class='dropdown'> <a class='right dropdown-toggle Wj_cursons' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span class='glyphicon glyphicon-chevron-down'></span> </a><ul class='dropdown-menu WJ-menu-right dropdown-menu-right' aria-labelledby='dropdownMenu1'>";
        newcontent += "<li id='comdel"+data.hid+"' class='commentdel'><a href='#'>删除</a></li><li><a href='#'>帮上头条</a></li><li><a href='#'>屏蔽这条微博</a></li><li><a href='#'>屏蔽该用户</a></li><li><a href='#'>取消关注该用户</a></li> <li role='separator' class='divider'></li><li><a href='#'>举报</a></li></ul></div></div>";
        newcontent += "<div class='WJ_text clearfix'>"+data.created_at+" 来自 微博 weibo.com</div>";
        newcontent += "<div class='WJ_text2 clearfix'>"+data.content+"</div>";
        if( data.images.length == 0 ){
          newcontent += "<div class='Wj_media_wrap clearfix'></div></div></div>";
        } else if( data.images.length > 1 ){
          newcontent += "<div class='Wj_media_wrap clearfix'><div class='Wj_media_wrap_ul clearfix'>";
          for(var a = data.images.length -1; a >= 0 ;a-- ){
            var imgurl = data.images[a].replace(/(.{17})/,'$1110_')
            newcontent += "<img src='/"+imgurl+"' alt=''>";
          }
          newcontent += "</div></div></div></div>"
        }else{
          var imgurl = data.images[0].replace(/(.{17})/,'$1167_')
          newcontent += "<div class='Wj_media_wrap clearfix'><div class='Wj_media_wrap_ul clearfix'><img src='/"+imgurl+"' alt=''></div></div></div></div>";
        }
        newcontent += "<div class='WJ_feed_handle clearfix'><ul class='WJ_row_line row'>";
        newcontent += "<li class='left'><span id='pos"+data.hid+"' class='glyphicon glyphicon-star-empty pos' >收藏</span></li>";
        newcontent += "<li class='left'><span class='glyphicon glyphicon-share' > "+data.transmits+"</span></li>";
        newcontent += "<li class='left'><span id='"+data.hid+"' class='glyphicon glyphicon-comment comshow' > "+data.comments+"</span></li>";
        newcontent += "<li class='left'><span id='good"+data.hid+"' class='glyphicon glyphicon-thumbs-up good' > "+data.favtimes+"</span></li>";
        newcontent += "</ul></div><div class='WE_feed_publish con"+data.hid+" clearfix'></div></li></div></li>";
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
        toastr.error('发布微博失败');
      }
    });
  });
});
