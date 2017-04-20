  $('#textarea').focus(function(){
    $('#cont-box').addClass('Weborder');

    $('#textarea').blur(function(){
      $('#cont-box').removeClass('Weborder');
    })
  })

	$(document).bind('propertychange input', function () {
         var length = 150;
         var content_len = $("#textarea").val().length;
         var in_len = length-content_len;
         // 当用户输入的字数大于制定的数时，让提交按钮失效
         // 小于制定的字数，就可以提交
         if(in_len >=0){
            $("#result").html('可输入'+in_len+'字');
            $('#issue').attr("disabled",false).addClass('bgred').removeClass('bgsmred');
            // 可以继续执行其他操作
         }else{
            $("#result").html('可输入'+in_len+'字');
            $('#issue').attr("disabled",true).addClass('bgsmred').removeClass('bgred');
            return false;
         }
        //  console.log( $('#textarea').val() );
         if ( $('#textarea').val() == '' ) {
           $('#issue').attr("disabled",true).addClass('bgsmred').removeClass('bgred');
          };

	});

	$(function(){
				/*瀑布流开始*/
				var container = $('.box-content ul:first');
				var loading=$('#imloading');
        var sqlJson=[];
        var skip = 0;
        var count = 5;
        var sqlfind=[];
        var search='index';

        // 获取后台信息统计数据
        $.ajax({
          url:'contentCount?search='+search,
          type:'get',
          // async:false,
          success:function(data){
            count = data;
            skip = 0;
          },
          error:function(data){
          }
        });

        // 我的收藏
        $('#mycollect').click(function(){
          search='mycollect';
          $('html, body').animate({scrollTop:50}, 'slow');
          loading.data("on",true);
          $('.box-content ul li:first').nextAll().remove();
          $('#emoji_btn_1').hide();
          $('.box-content ul li:first').replaceWith('<li class="panel panel-default boxtest" style="height:50px;padding:10px;">我的收藏</li>');
          $.ajax({
            url:'contentCount?search='+search,
            type:'get',
            success:function(data){
              count = data;
              skip = 0;
            },
            error:function(data){
            }
          });
        })
        // 我的点赞
        $('#myfavtimes').click(function(){
          search='myfavtimes';
          $('html, body').animate({scrollTop:50}, 'slow');
          loading.data("on",true);
          $('.box-content ul li:first').nextAll().remove();
          $('#emoji_btn_1').hide();
          $('.box-content ul li:first').replaceWith('<li class="panel panel-default boxtest" style="height:50px;padding:10px;">我的赞</li>');
          $.ajax({
            url:'contentCount?search='+search,
            type:'get',
            success:function(data){
              count = data;
              skip = 0;
            },
            error:function(data){
            }
          });
        })

        // 侧边栏到底改变css
        $(window).scroll(function(){
          if ( $(document).height() - $(document).scrollTop() <= 900 ) {
            $('#slideleft').addClass('slidefloat');
          } else {
            $('#slideleft').removeClass('slidefloat');
          }
        })

				// 初始化loading状态
				loading.data("on",true);
				/*判断瀑布流最大布局宽度，最大为1280*/
				function tores(){
					var tmpWid=$(window).width();
					if(tmpWid>622){
						tmpWid=622;
					}else{
						var column=Math.floor(tmpWid/320);
						tmpWid=column*320;
					}
					$('.box-content').width(tmpWid);
				}
				tores();
				$(window).resize(function(){
					tores();
				});
				container.imagesLoaded(function(){
				  container.masonry({
				  	columnWidth: 622,
				    itemSelector : '.boxtest',
				    isFitWidth: true,//是否根据浏览器窗口大小自动适应默认false
				    isAnimated: true,//是否采用jquery动画进行重拍版
				    isRTL:false,//设置布局的排列方式，即：定位砖块时，是从左向右排列还是从右向左排列。默认值为false，即从左向右
				    isResizable: true,//是否自动布局默认true
				    animationOptions: {
						duration: 800,
						easing: 'easeInOutBack',//如果你引用了jQeasing这里就可以添加对应的动态动画效果，如果没引用删除这行，默认是匀速变化
						queue: false//是否队列，从一点填充瀑布流
					}
				  });
				});

				/*模拟从后台获取到的数据*/
				// var sqlJson=[{'title':'瀑布流其实就是几个函数的事！','intro':'爆料，苏亚雷斯又咬人啦，C罗哪有内马尔帅，梅西今年要不夺冠，你就去泰国吧，老子买了阿根廷赢得彩票，输了就去不成了。','src':'./images/one.jpeg','writer':'志强不息','date':'2小时前','looked':321},{'title':'瀑布流其实就是几个函数的事！','intro':'爆料了，苏亚雷斯又咬人啦，C罗哪有内马尔帅，梅西今年要不夺冠，你就去泰国吧，老子买了阿根廷赢得彩票，输了就去不成了。','src':'./images/demo2.jpg','writer':'志强不息','date':'2小时前','looked':321},{'title':'瀑布流其实就是几个函数的事！','intro':'爆料了，苏亚雷斯又咬人啦，C罗哪有内马尔帅，梅西今年要不夺冠，你就去泰国吧，老子买了阿根廷赢得彩票，输了就去不成了。','src':'./images/p1.jpg','writer':'志强不息','date':'2小时前','looked':321},{'title':'瀑布流其实就是几个函数的事！','intro':'爆料了，苏亚雷斯又咬人啦，C罗哪有内马尔帅，梅西今年要不夺冠，你就去泰国吧，老子买了阿根廷赢得彩票，输了就去不成了。','src':'./images/p1.jpg','writer':'志强不息','date':'2小时前','looked':321}];
				/*本应该通过ajax从后台请求过来类似sqljson的数据然后，便利，进行填充，这里我们用sqlJson来模拟一下数据*/
				$(window).scroll(function(){
					if(!loading.data("on")) return;
          // toastr.success('正在加载中');
					// 计算所有瀑布流块中距离顶部最大，进而在滚动条滚动时，来进行ajax请求，方法很多这里只列举最简单一种，最易理解一种
					var itemNum=$('#box-content').find('.boxtest').length;
					var itemArr=[];
					itemArr[0]=$('#box-content').find('.boxtest').eq(itemNum-1).offset().top+$('#box-content').find('.boxtest').eq(itemNum-1)[0].offsetHeight;
					var maxTop=Math.max.apply(null,itemArr);
					if(maxTop<$(window).height()+$(document).scrollTop()){

            $.ajax({
              url:'contentIndex?skip='+skip+'&search='+search,
              type:'get',
              // async:false,
              success:function(data){
                sqlJson = data;
              },
              error:function(data){
              }
            });
            // 返回登陆用户是否收藏,点赞
            $.ajax({
              url:'contentFindcollect',
              type:'get',
              // async:false,
              success:function(data){
                sqlfind['collect'] = data['collect'];
                sqlfind['favtimes'] = data['favtimes'];
              },
              error:function(data){
              }
            })
						//加载更多数据
						loading.data("on",false);
            toastr.success('正在加载中');
						(function(sqlJson){
							/*这里会根据后台返回的数据来判断是否你进行分页或者数据加载完毕这里假设大于30就不在加载数据*/
              if(itemNum>count ){
              // if(itemNum>5 ){
								// loading.text('就有这么多了！');
                container.append("<div id='imloading' class='well well-sm' style='width:600px; text-align:center;background:#f2dede;' >这是全部的了</div>")
                // toastr.success('只有这么多了!');
							}else{
								var html="";
                skip = skip + 10;
								for(var i = 0; i < sqlJson.length ; i++){
									html += "<li id='li"+sqlJson[i].hid+"' class='panel panel-default boxtest'><div><div class='Wejoy_feed_detail clearfix'><a href='/home/user/"+sqlJson[i].uid+"'><div class='Wejoy_face'><img src='/"+sqlJson[i].usericon+"' alt=''></div></a><div class='Wejoy_detail'><div class='WJ_info clearfix'>";
									html += "<span class='left'><a href='/home/user/"+sqlJson[i].uid+"'>"+sqlJson[i].username+"</a></span>";
									html += "<div class='dropdown'> <a class='right dropdown-toggle Wj_cursons' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span class='glyphicon glyphicon-chevron-down'></span> </a><ul class='dropdown-menu WJ-menu-right dropdown-menu-right' aria-labelledby='dropdownMenu1'>";
                  if( sqlJson[i].uid == sqlJson[i].bid ){
									  html += "<li id='comdel"+sqlJson[i].hid+"' class='commentdel'><a href='#' >删除</a></li><li><a href='#'>帮上头条</a></li><li><a href='#'>屏蔽这条微博</a></li><li><a href='#'>屏蔽该用户</a></li><li><a href='#'>取消关注该用户</a></li> <li role='separator' class='divider'></li><li><a href='#'>举报</a></li></ul></div></div>";
                  } else {
                    html += "<li><a href=''>帮上头条</a></li><li><a href=''>屏蔽这条微博</a></li><li><a href='#'>屏蔽该用户</a></li><li><a href='#'>取消关注该用户</a></li> <li role='separator' class='divider'></li><li><a href='#'>举报</a></li></ul></div></div>";
                  }
									html += "<div class='WJ_text clearfix'>"+sqlJson[i].created_at+" 来自 微博 weibo.com</div>";
									html += "<div class='WJ_text2 clearfix'>"+sqlJson[i].content+"</div>";
                  if( sqlJson[i].images[0] == undefined ){
                    html += "<div class='Wj_media_wrap clearfix'></div></div></div>";
                  }else{
                    html += "<div class='Wj_media_wrap clearfix'><img src='/"+sqlJson[i].images[0]+"' alt=''></div></div></div>";
                  }
									html += "<div class='WJ_feed_handle clearfix'><ul class='WJ_row_line row'>";
                  if( $.inArray( sqlJson[i].hid,sqlfind['collect'] ) == -1 ){
                    html += "<li class='left'><span id='pos"+sqlJson[i].hid+"' class='glyphicon glyphicon-star-empty pos' >收藏</span></li>";
                  }else{
                    html += "<li class='left'><span id='pos"+sqlJson[i].hid+"' class='glyphicon glyphicon-star-empty bgorigin posdie' >已收藏</span></li>";
                  }
									html += "<li class='left'><span class='glyphicon glyphicon-share' > "+sqlJson[i].transmits+"</span></li>";
									html += "<li class='left'><span id='"+sqlJson[i].hid+"' class='glyphicon glyphicon-comment comshow' > "+sqlJson[i].countcom+"</span></li>";
                  if( $.inArray(sqlJson[i].hid,sqlfind['favtimes'] ) == -1 ){
                    html += "<li class='left'><span id='good"+sqlJson[i].hid+"' class='glyphicon glyphicon-thumbs-up good' > "+sqlJson[i].favtimes+"</span></li>";
                  }else{
                    html += "<li class='left'><span id='good"+sqlJson[i].hid+"' class='glyphicon glyphicon-thumbs-up bgorigin gooddie' > "+sqlJson[i].favtimes+"</span></li>";
                  }
									html += "</ul></div><div class='WE_feed_publish con"+sqlJson[i].hid+" clearfix'></div></li></div></li>";

								}

								/*模拟ajax请求数据时延时800毫秒*/
								var time=setTimeout(function(){
									$(html).find('img').each(function(index){
										loadImage($(this).attr('src'));
									})
									var $newElems = $(html).css({ opacity: 0}).appendTo(container);
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
									$newElems.imagesLoaded(function(){
										$newElems.animate({ opacity: 1},800);
										container.masonry( 'appended', $newElems,true);
										loading.data("on",true);
										clearTimeout(time);
							        });
								},800)
							}
						})(sqlJson);
					}
				});

				 function loadImage(url) {
				      var img = new Image();
				      //创建一个Image对象，实现图片的预下载
				       img.src = url;
				       if (img.complete) {
				          return img.src;
				       }
				       img.onload = function () {
				        	return img.src;
				       };
				  };
				  // loadImage('./images/one.jpeg',test());
				 /*item hover效果*/
				//  var rbgB=['#71D3F5','#F0C179','#F28386','#8BD38B'];
				//  $('#box-content').on('mouseover','boxtest',function(){
				//  	var random=Math.floor(Math.random() * 4);
				//  	$(this).stop(true).animate({'backgroundColor':rbgB[random]},1000);
				//  });
				//  $('#box-content').on('mouseout','boxtest',function(){
				//  	$(this).stop(true).animate({'backgroundColor':'#fff'},1000);
				//  });
		})
