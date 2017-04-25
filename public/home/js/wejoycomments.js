$(function(){
  $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
           dataType: 'json',
        }
    });
    var ix = 1;
    // 二级评论
    $('.twocom').live('click',function(){
      var twocom ='';
      var newicon = $('.W_face_radius').attr('src');
      if (newicon == undefined) {
        newicon = $('#ddicon').attr('src');
      }
      var comid = $(this).attr('id').replace(/twocom/, "");
      $(document).live('propertychange input', function () {
          if ( $('#twocomments'+comid).val() == '' ) {
            $('#dotwocomment'+comid).attr("disabled",true).addClass('bgsmred').removeClass('bgred');
          }else{
            $('#dotwocomment'+comid).attr("disabled",false).addClass('bgred').removeClass('bgsmred');
          }
       })


      twocom = "<div class='usercom_list'> ";
      twocom += "<div class='usercom_list_box'> ";
      twocom += "<div class='WE_feed_comments'> ";
      twocom += "<div class='WE_publish_face'> ";
      twocom += "<img src='"+newicon+"' alt='' > ";
      twocom += "</div> ";
      twocom += "<div class='WE_publish clearfix'> ";
      twocom += "<form id='twoform"+comid+"' action=' method='post'>";
      twocom += "<div style='width:100%;' class='WE_feed_publish_comments' id='cont-box2'> ";
      twocom += "<input type='text' name='description' id='twocomments"+comid+"' value='' /> ";
      twocom += "</div> ";
      twocom += "<div class='tools-box' style='border:0px solid red;'> ";
      twocom += "<div class='operator-box-btn'>";
      twocom += "</div> ";
      twocom += "<div class='submit-btn'>";
      twocom += "<input id='dotwocomment"+comid+"' type='button'  disabled=true class='bgsmred' value='评论' /> ";
      twocom += "</div> ";
      twocom += "</div> ";
      twocom += "</form> ";
      twocom += "</div> ";
      twocom += "</div> ";
      twocom += "</div> ";
      $(this).removeClass('twocom').addClass('twocomdie');
      $(this).parent().after(twocom);

      // 二级评论提交
       $('#dotwocomment'+comid).live('click', function () {
          data = $('#twoform'+comid).serialize();
          data += '&cid='+comid;
          var This = $(this);
          $.ajax({
            url:'twocontentIssue',
            data: data,
            type: 'post',
            dataType: 'json',
            success:function(data){
              toastr.success('评论成功');
              $('#twocomments'+comid).val(' ');
              var conlist = '';
              var name = $('.name').attr('title');
              if( name == undefined ){
                name = $('#ddicon').attr('alt');
              }
              conlist += "<div class='twolist_li'><div class='list_con2' ><div class='twolist_text'>";
              conlist += "<a href='/home/user/"+data[0].uuid+"'>"+name+"</a> "+data[0].description;
              conlist += "</div>";
              conlist += "<div class='clearfix'>";
              conlist += "<div class='left'>"+data[0].created_at+"</div>";
              conlist += "<div class='right'><span id='threecom"+data[0].hid+"' class='glyphicon glyphicon-comment threecom right'></span> </div>";
              conlist += "</div>";
              conlist += "</div></div> ";
              This.parents('.usercom_list').next().children('.twolist_ul').prepend(conlist);
            },
            error:function(jqXHR, textStatus, errorThrown){
              toastr.error('评论失败,联系管理员吧');
            }
          })
       })


    });

    // 无限级评论
    $('.threecom').live('click',function(){
      var twocom ='';
      var newicon = $('.W_face_radius').attr('src');
      if (newicon == undefined) {
        newicon = $('#ddicon').attr('src');
      }
      var comid = $(this).attr('id').replace(/threecom/, "");
      $(document).live('propertychange input', function () {
          if ( $('#threecomments'+comid).val() == '' ) {
            $('#dothreecomment'+comid).attr("disabled",true).addClass('bgsmred').removeClass('bgred');
          }else{
            $('#dothreecomment'+comid).attr("disabled",false).addClass('bgred').removeClass('bgsmred');
          }
       })


      threecom = "<div class='usercom_list'> ";
      threecom += "<div class='usercom_list_box'> ";
      threecom += "<div class='WE_feed_comments'> ";
      threecom += "<div class='WE_publish_face'> ";
      threecom += "<img src='"+newicon+"' alt='' > ";
      threecom += "</div> ";
      threecom += "<div class='WE_publish clearfix'> ";
      threecom += "<form id='twoform"+comid+"' action=' method='post'>";
      threecom += "<div style='width:100%;' class='WE_feed_publish_comments' id='cont-box2'> ";
      threecom += "<input type='text' name='description' id='threecomments"+comid+"' value='' /> ";
      threecom += "</div> ";
      threecom += "<div class='tools-box' style='border:0px solid red;'> ";
      threecom += "<div class='operator-box-btn'>";
      threecom += "</div> ";
      threecom += "<div class='submit-btn'>";
      threecom += "<input id='dothreecomment"+comid+"' type='button'  disabled=true class='bgsmred' value='评论' /> ";
      threecom += "</div> ";
      threecom += "</div> ";
      threecom += "</form> ";
      threecom += "</div> ";
      threecom += "</div> ";
      threecom += "</div> ";
      $(this).removeClass('threecom').addClass('threecomdie');
      $(this).parent().after(threecom);

      // 二级评论提交
       $('#dothreecomment'+comid).live('click', function () {

          data = 'description='+$('#threecomments'+comid).val();
          data += '&cid='+comid;
          var This = $(this);
          $.ajax({
            url:'twocontentIssue?type=three',
            data: data,
            type: 'post',
            dataType: 'json',
            success:function(data){
              toastr.success('评论成功');
              $('#threecomments'+comid).val(' ');
              var conlist1 = '';
              var name = $('.name').attr('title');
              if( name == undefined ){
                name = $('#ddicon').attr('alt');
              }
              conlist1 += "<div class='twolist_li'><div class='list_con2' ><div class='twolist_text'>";
              if ( data[0].uuname == undefined ) {
                conlist1 += "<a href='/home/user/"+data[0].uuid+"'>"+name+"</a> "+data[0].description;
              }else{
                conlist1 += "<a href='/home/user/"+data[0].uuid+"'>"+name+"</a> <a href='/home/user/"+data[0].uuid+"'> @"+data[0].uuname+"</a>"+data[0].description;
              }
              conlist1 += "</div>";
              conlist1 += "<div class='clearfix'>";
              conlist1 += "<div class='left'>"+data[0].created_at+"</div>";
              conlist1 += "<div class='right'><span id='threecom"+data[0].hid+"' class='glyphicon glyphicon-comment threecom right'></span> </div>";
              conlist1 += "</div>";
              conlist1 += "</div></div> ";
              This.parents('.twolist_li').before(conlist1);
            },
            error:function(jqXHR, textStatus, errorThrown){
              toastr.error('评论失败,联系管理员吧');
            }
          })
       })


    });

    $('.twocomdie').live('click',function(){
      $(this).parent().next().remove();
      $(this).removeClass('twocomdie').addClass('twocom');
    })
    $('.threecomdie').live('click',function(){
      $(this).parent().next().remove();
      $(this).removeClass('threecomdie').addClass('threecom');
    })

    // 一级评论删除
    $('.one-glyphicon-remove').live('click',function(){
      var posid = $(this).attr('id').replace(/onegly/, "");
      $.ajax({
        url:'contentOnegly?onegly='+posid,
        type:'get',
        success:function(data){
          toastr.success('评论已删除');
          $('#listli'+posid).remove();
        },
        error:function(jqXHR, textStatus, errorThrown){
          toastr.error(jqXHR.responseText);
        }
      })
    })

// 收藏
  $('.pos').live('click',function(){
    var posid = $(this).attr('id').replace(/pos/, "");
    $.ajax({
      url:'contentPos?pos='+posid,
      type:'get',
      success:function(data){
        toastr.success('收藏成功');
        $('#pos'+posid).addClass('bgorigin');
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
        $('#pos'+posid).removeClass('bgorigin');
        $('#pos'+posid).text('收藏');
        $('#pos'+posid).removeClass('posdie').addClass('pos');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseText);
      }
    })
  })
  // 删除微博
  $('.commentdel').live('click',function(){
    var comdelid = $(this).attr('id').replace(/comdel/, "");
    $.ajax({
      url:'commentdel?mid='+comdelid,
      type:'get',
      success:function(data){
        toastr.success('删除成功');
        $('#li'+comdelid).remove();
        $('.emoji_btn').hide();
        $('#emoji_btn_1').show();
      },
      error:function(data){
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
        $('#good'+goodid).addClass('bgorigin');
        $text = $('#good'+goodid).text();
        $text++;
        $('#good'+goodid).text(" "+$text);
        $('#good'+goodid).removeClass('good').addClass('gooddie');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error('我被你玩坏了');
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
        $('#good'+goodid).removeClass('bgorigin');
        $text = $('#good'+goodid).text();
        $text--;
        $('#good'+goodid).text(" "+$text);
        $('#good'+goodid).removeClass('gooddie').addClass('good');
      },
      error:function(jqXHR, textStatus, errorThrown){
        toastr.error('我被你玩坏了');
      }
    })
  })
// 点赞结束

  $('.comnone').live('click',function(){
    var comid = $(this).attr('id');
    var emojibi = $(this).attr('name');
    $(this).removeClass('comnone').addClass('comshow');
    $('.con'+comid).empty();
    $('#'+emojibi).remove();
  })
  $('.comshow').live('click',function(){
    ix++;
    $(this).removeClass('comshow').addClass('comnone');
    var comid = $(this).attr('id');
    $(this).attr({ name:'emoji_btn_'+ix });
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
        $.ajax({
          url:'contentIssue',
          data: data,
          type: 'post',
          dataType: 'json',
          success:function(data){
            toastr.success('评论成功');
            $text = $('#'+comid).text();
            $text++;
            $('#'+comid).text(" "+$text);
            var newicon = $('.W_face_radius').attr('src');
            var uname = $('.name').attr('title');
            if (uname == undefined) {
               uname = $('#ddicon').attr('alt');
            }
            if( newicon == undefined ){
              newicon = $('#ddicon').attr('src');
            }
            var newconlist = '';
            newconlist += "<div id='listli"+data[0].hid+"' class='list_li'> ";
            newconlist += "<!--评论头像 --> ";
            newconlist += "<div class='WE_face'> ";
            newconlist += "<img src='"+newicon+"' alt='' /> ";
            newconlist += "</div> ";
            newconlist += "<!-- 评论内容 --> ";
            newconlist += "<div class='list-con'> ";
            newconlist += "<div class='WE_text'> ";
            newconlist += "<a href='/home/user/"+data[0].nuid+"'>"+uname+"</a>  <span>"+data[0].description;
            newconlist += "</span></div> ";
            newconlist += "<div class='WE_func clearfix'> ";
            newconlist += "<div class='WE_time'>";
            newconlist += data[0].created_at;
            newconlist += "<span id='onegly"+data[0].hid+"' class='glyphicon glyphicon-remove one-glyphicon-remove right'></span> ";
            newconlist += "<span id='twocom"+data[0].hid+"' class='glyphicon glyphicon-comment twocom right'></span></div> ";
            newconlist += "<div class='usercom_list S_bg1'><div class='twolist_ul'>";
            newconlist += "</div> ";
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
    var newicon = $('.W_face_radius').attr('src');
    if (newicon == undefined) {
      newicon = $('#ddicon').attr('src');
    }
    conlist = "<div class='WE_repeat clearfix'> ";
    conlist += "<!-- 发布评论 --> ";
    conlist += "<div class='WE_feed_comments'> ";
    conlist += "<div class='WE_publish_face'> ";
    conlist += "<img src='"+newicon+"' alt='' > ";
    conlist += "</div> ";
    conlist += "<div class='WE_publish clearfix'> ";
    conlist += "<form id='testform"+comid+"' action=' method='post'>";
    conlist += "<div style='width:100%;' class='WE_feed_publish_comments' id='cont-box2'> ";
    conlist += "<input type='text' name='description' id='publishcomments"+comid+"' value='' /> ";
    conlist += "</div> ";
    conlist += "<div class='tools-box' style='border:0px solid red;'> ";
    conlist += "<div class='operator-box-btn'>";
    conlist += "</div> ";
    conlist += "<div class='submit-btn'>";
    conlist += "<input id='docomment"+comid+"' type='button'  disabled=true class='bgsmred' value='评论' /> ";
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
            conlist += "<div id='listli"+data[i].hid+"' class='list_li'> ";
            conlist += "<!--评论头像 --> ";
            conlist += "<div class='WE_face'> ";
            if( data[i].usericon.length <= 0 ){
              conlist += "<img src='/home/image/default.jpg'> ";
            }else{
              conlist += "<img src='/"+data[i].usericon+"'> ";
            }
            conlist += "</div> ";
            conlist += "<!-- 评论内容 --> ";
            conlist += "<div class='list-con'> ";
            conlist += "<div class='WE_text'> ";
            conlist += "<a href='/home/user/"+data[i].nuid+"'>"+data[i].uname+"</a>  <span>"+data[i].description;
            conlist += "</span></div> ";
            conlist += "<div class='WE_func clearfix'> ";
            conlist += "<div class='WE_time'>";
            conlist += data[i].created_at;
            if( data[i].del == 1 ){
              conlist += "<span id='onegly"+data[i].hid+"' class='glyphicon glyphicon-remove one-glyphicon-remove right'></span>";
            }
            conlist += "<span id='twocom"+data[i].hid+"' class='glyphicon glyphicon-comment twocom right'></span></div> ";
            // 二级评论
            conlist += "<div class='usercom_list S_bg1'><div class='twolist_ul'>";
            for(var a = 0; a < data[i].two.length; a++){
              conlist += "<div class='twolist_li'><div class='list_con2' ><div class='twolist_text'>";
              if ( data[i].two[a].uuname == undefined ) {
                conlist += "<a href='/home/user/"+data[i].two[a].nuid+"'>"+data[i].two[a].uname+"</a> "+data[i].two[a].description;
              }else{
                conlist += "<a href='/home/user/"+data[i].two[a].nuid+"'>"+data[i].two[a].uname+"</a><a href='/home/user/"+data[i].two[a].uunid+"'> @"+data[i].two[a].uuname+"</a> "+data[i].two[a].description;
              }
              conlist += "</div>";
              conlist += "<div class='clearfix'>";
              conlist += "<div class='left'>"+data[i].two[a].created_at+"</div>";
              conlist += "<div class='right'><span id='threecom"+data[i].two[a].hid+"' class='glyphicon glyphicon-comment threecom right'></span> </div>";
              conlist += "</div>";
              conlist += "</div></div> ";
            }
            conlist += "</div></div> ";
            conlist += "</div> ";
            conlist += "</div> ";
            conlist += "</div> ";

          }
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
