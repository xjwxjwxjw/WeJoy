$(function(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
           dataType: 'json',
        }
    });
// 收藏
  $('.pos').live('click',function(){
    var posid = $(this).attr('id').replace(/pos/, "");
    $.ajax({
      url:'contentPos?pos='+posid,
      type:'get',
      success:function(data){
        toastr.success('收藏成功');
        $('#pos'+posid).css('color','#ff6700');
        $('#pos'+posid).text('已收藏');
        $('#pos'+posid).removeClass('pos').addClass('posdie');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseText);
      }
    })
  })
// 取消收藏
  $('.posdie').live('click',function(){
    var posid = $(this).attr('id').replace(/pos/, "");
    $.ajax({
      url:'contentPos?posdie='+posid,
      type:'get',
      success:function(data){
        toastr.success('取消收藏');
        $('#pos'+posid).css('color','');
        $('#pos'+posid).text('收藏');
        $('#pos'+posid).removeClass('posdie').addClass('pos');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseText);
      }
    })
  })
// 点赞
  $('.good').live('click',function(){
    var goodid = $(this).attr('id').replace(/good/, "");
    $.ajax({
      url:'contentGood?good='+goodid,
      type:'get',
      success:function(data){
        toastr.success('点赞成功');
        $('#good'+goodid).css('color','#ff6700');
        $text = $('#good'+goodid).text();
        $text++;
        $('#good'+goodid).text(" "+$text);
        $('#good'+goodid).removeClass('good').addClass('gooddie');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseText);
      }
    })
  })
// 取消点赞
  $('.gooddie').live('click',function(){
    var goodid = $(this).attr('id').replace(/good/, "");
    $.ajax({
      url:'contentGood?gooddie='+goodid,
      type:'get',
      success:function(data){
        toastr.success('取消点赞');
        $('#good'+goodid).css('color','');
        $text = $('#good'+goodid).text();
        $text--;
        $('#good'+goodid).text(" "+$text);
        $('#good'+goodid).removeClass('gooddie').addClass('good');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseText);
      }
    })
  })
// 点赞结束

  $('.comnone').live('click',function(){
    var comid = $(this).attr('id');
    $(this).removeClass('comnone').addClass('comshow');
    $('.con'+comid).empty();
    $('.emoji_btn').hide();
  })
  $('.comshow').live('click',function(){
    $(this).removeClass('comshow').addClass('comnone');
    var comid = $(this).attr('id');
    // 评论按钮的禁用和解除
    $(document).live('propertychange input', function () {
        if ( $('#publishcomments'+comid).val() == '' ) {
          $('#docomment'+comid).attr("disabled",true).addClass('bgsmred').removeClass('bgred');
        }else{
          $('#docomment'+comid).attr("disabled",false).addClass('bgred').removeClass('bgsmred');
        }
     })

    //  添加一级评论
     $('#docomment'+comid).live('click', function () {
        data = $('#testform'+comid).serialize();
        data += '&mid='+comid;
        console.log(data);
        $.ajax({
          url:'contentIssue',
          data: data,
          type: 'post',
          dataType: 'json',
          success:function(data){
            toastr.success('评论成功');
            var newconlist = '';
            newconlist = "<div class='list_li'> ";
            newconlist += "<!--评论头像 --> ";
            newconlist += "<div class='WE_face'> ";
            newconlist += "<img src='/home/1.jpg' alt='' /> ";
            newconlist += "</div> ";
            newconlist += "<!-- 评论内容 --> ";
            newconlist += "<div class='list-con'> ";
            newconlist += "<div class='WE_text'> ";
            newconlist += "<a>"+$('.name').attr('title')+"</a>  <span>"+data[0].description;
            newconlist += "</span></div> ";
            newconlist += "<div class='WE_func clearfix'> ";
            newconlist += "<div class='WE_time'>";
            newconlist += data[0].created_at;
            newconlist += "</div> ";
            newconlist += "<div class=''> ";
            newconlist += "</div> ";
            newconlist += "</div> ";
            newconlist += "</div> ";
            newconlist += "</div> ";
            $('.list_box'+comid).prepend(newconlist);
            $('#publishcomments'+comid).val('');
            // 解析表情
            $(".WE_text").emojiParse({
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
          },
          error:function(jqXHR, textStatus, errorThrown){
            toastr.error(jqXHR.responseText);
          }
        })
     })

    // 评论列表html片段
    var conlist = '';
    conlist = "<div class='WE_repeat clearfix'> ";
    conlist += "<!-- 发布评论 --> ";
    conlist += "<div class='WE_feed_comments'> ";
    conlist += "<div class='WE_publish_face'> ";
    conlist += "<img src='/home/1.jpg' alt='' > ";
    conlist += "</div> ";
    conlist += "<div class='WE_publish clearfix'> ";
    conlist += "<form id='testform"+comid+"' action=' method='post'>";
    conlist += "<div class='WE_feed_publish_comments' id='cont-box2'> ";
    conlist += "<input type='text' name='description' id='publishcomments"+comid+"' value='' /> ";
    conlist += "</div> ";
    conlist += "<div class='tools-box' style='border:0px solid red;'> ";
    conlist += "<div class='operator-box-btn'>";
    conlist += "</div> ";
    conlist += "<div class='submit-btn'>";
    conlist += "<input id='docomment"+comid+"' type='button' class='bgsmred' value='评论' /> ";
    conlist += "</div> ";
    conlist += "</div> ";
    conlist += "</form> ";
    conlist += "</div> ";
    conlist += "</div> ";
    conlist += "<!-- 评论列表 --> ";
    conlist += "<div class='repeat_list'> ";
    conlist += "<!-- 列表标题 --> ";
    conlist += "<div class='tab_feed_a'> ";
    conlist += "</div> ";
    conlist += "<!-- 评论列表内容 --> ";
    conlist += "<div class='list_box"+comid+"'> ";
    conlist += "<!-- 一级评论 --> ";
    $.ajax({
      url:'contentComment?id='+comid,
      type:'get',
      success:function(data){
        // 遍历评论列表数据
          for(var i = 0; i < data.length; i++){
            conlist += "<div class='list_li'> ";
            conlist += "<!--评论头像 --> ";
            conlist += "<div class='WE_face'> ";
            conlist += "<img src='/home/1.jpg' alt='' /> ";
            conlist += "</div> ";
            conlist += "<!-- 评论内容 --> ";
            conlist += "<div class='list-con'> ";
            conlist += "<div class='WE_text'> ";
            conlist += "<a>"+data[i].uname+"</a>  <span>"+data[i].description;
            conlist += "</span></div> ";
            conlist += "<div class='WE_func clearfix'> ";
            conlist += "<div class='WE_time'>";
            conlist += data[i].created_at;
            conlist += "</div> ";
            conlist += "<div class=''> ";
            conlist += "</div> ";
            conlist += "</div> ";
            conlist += "</div> ";
            conlist += "</div> ";
          }
        conlist += "</div> ";
        conlist += "</div> ";
        conlist += "</div>";
        conlist += "</div>";
        $('.con'+comid).append(conlist);
        // // 绑定表情
        $('#publishcomments'+comid).emoji({
          showTab: true,
          animation: 'fade',
          icons: [{
              name: "贴吧表情",
              path: "/home/image/tieba/",
              maxNum: 50,
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
              },
              title: {
                  1: "呵呵",
                  2: "哈哈",
                  3: "吐舌",
                  4: "啊",
                  5: "酷",
                  6: "怒",
                  7: "开心",
                  8: "汗",
                  9: "泪",
                  10: "黑线",
                  11: "鄙视",
                  12: "不高兴",
                  13: "真棒",
                  14: "钱",
                  15: "疑问",
                  16: "阴脸",
                  17: "吐",
                  18: "咦",
                  19: "委屈",
                  20: "花心",
                  21: "呼~",
                  22: "笑脸",
                  23: "冷",
                  24: "太开心",
                  25: "滑稽",
                  26: "勉强",
                  27: "狂汗",
                  28: "乖",
                  29: "睡觉",
                  30: "惊哭",
                  31: "生气",
                  32: "惊讶",
                  33: "喷",
                  34: "爱心",
                  35: "心碎",
                  36: "玫瑰",
                  37: "礼物",
                  38: "彩虹",
                  39: "星星月亮",
                  40: "太阳",
                  41: "钱币",
                  42: "灯泡",
                  43: "茶杯",
                  44: "蛋糕",
                  45: "音乐",
                  46: "haha",
                  47: "胜利",
                  48: "大拇指",
                  49: "弱",
                  50: "OK"
              }
          }, {
              path: "/home/image/qq/",
              maxNum: 91,
              excludeNums: [41, 45, 54],
              file: ".gif",
              placeholder: "#qq_{alias}#"
          }]
      });
        // 解析表情
        $(".WE_text").emojiParse({
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
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseText);
      }
    })

  })

  // // 绑定表情
  $("#textarea").emoji({
    showTab: true,
    animation: 'fade',
    icons: [{
        name: "贴吧表情",
        path: "/home/image/tieba/",
        maxNum: 50,
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
        },
        title: {
            1: "呵呵",
            2: "哈哈",
            3: "吐舌",
            4: "啊",
            5: "酷",
            6: "怒",
            7: "开心",
            8: "汗",
            9: "泪",
            10: "黑线",
            11: "鄙视",
            12: "不高兴",
            13: "真棒",
            14: "钱",
            15: "疑问",
            16: "阴脸",
            17: "吐",
            18: "咦",
            19: "委屈",
            20: "花心",
            21: "呼~",
            22: "笑脸",
            23: "冷",
            24: "太开心",
            25: "滑稽",
            26: "勉强",
            27: "狂汗",
            28: "乖",
            29: "睡觉",
            30: "惊哭",
            31: "生气",
            32: "惊讶",
            33: "喷",
            34: "爱心",
            35: "心碎",
            36: "玫瑰",
            37: "礼物",
            38: "彩虹",
            39: "星星月亮",
            40: "太阳",
            41: "钱币",
            42: "灯泡",
            43: "茶杯",
            44: "蛋糕",
            45: "音乐",
            46: "haha",
            47: "胜利",
            48: "大拇指",
            49: "弱",
            50: "OK"
        }
    }, {
        path: "/home/image/qq/",
        maxNum: 91,
        excludeNums: [41, 45, 54],
        file: ".gif",
        placeholder: "#qq_{alias}#"
    }]
});
})
