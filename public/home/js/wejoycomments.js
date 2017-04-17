$(function(){
  $('.comnone').live('click',function(){
    $(this).removeClass('comnone').addClass('comshow');
    $('.con1').empty();
  })
  $('.comshow').live('click',function(){
    console.log(1);
    $(this).removeClass('comshow').addClass('comnone');
      var conlist = '';
      conlist = "<div class='WE_repeat clearfix'> ";
       conlist += "<!-- 发布评论 --> ";
       conlist = "<div class='WE_feed_comments'> ";
        conlist += "<div class='WE_publish_face'> ";
         conlist += "<img src='/home/1.jpg' alt='' > ";
        conlist += "</div> ";
        conlist += "<div class='WE_publish clearfix'> ";
         conlist += "<form id='testform' action=' method='post'>";
           conlist += "<input type='hidden' name='_token' value='gyqLfJ5oEneLRQFZJ6Y6VO7jP1lmwC3D3ZBSNlcG'>";
          conlist += "<div class='WE_feed_publish_comments' id='cont-box2'> ";
           conlist += "<input type='text' name='comments' id='publishcomments' value='' /> ";
          conlist += "</div> ";
          conlist += "<div class='tools-box' style='border:0px solid red;'> ";
           conlist += "<div class='operator-box-btn'>";
            conlist += "<span class='face-icon'>☺</span>";
            conlist += "<span class='img-icon'>▧</span>";
           conlist += "</div> ";
           conlist += "<div class='submit-btn'>";
            conlist += "<input id='docomment' type='button' class='bgsmred' value='评论' /> ";
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
        conlist += "<div class='list_box'> ";
         conlist += "<!-- 一级评论 --> ";
         conlist += "<div class='list_li'> ";
          conlist += "<!--评论头像 --> ";
          conlist += "<div class='WE_face'> ";
           conlist += "<img src='/home/1.jpg' alt='' /> ";
          conlist += "</div> ";
          conlist += "<!-- 评论内容 --> ";
          conlist += "<div class='list-con'> ";
           conlist += "<div class='WE_text'> ";
            conlist += "<a>温柔大哥</a> : 详情看主页 ";
           conlist += "</div> ";
           conlist += "<div class='WE_func clearfix'> ";
            conlist += "<div class='WE_time'>";
             conlist += "11分钟前";
            conlist += "</div> ";
            conlist += "<div class=''> ";
            conlist += "</div> ";
           conlist += "</div> ";
          conlist += "</div> ";
         conlist += "</div> ";
        conlist += "</div> ";
       conlist += "</div> ";
      conlist += "</div>";

      $('.con1').append(conlist);

  })

  // // 绑定表情
  $('.face-icon').SinaEmotion($('#publishcomments'));
  // 测试本地解析
  function out() {
    var inputText = $('.text').val();
    $('#info-show ul').append(reply(AnalyticEmotion(inputText)));
  }

  $(document).bind('propertychange input', function () {

      if ( $('#publishcomments').val() == '' ) {
        $('#docomment').attr("disabled",true).addClass('bgsmred').removeClass('bgred');
      }else{
        $('#docomment').attr("disabled",false).addClass('bgred').removeClass('bgsmred');
      }

  })
})
