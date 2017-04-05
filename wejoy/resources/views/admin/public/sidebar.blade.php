<!-- sidebar start -->
<div class="admin-sidebar">
  <link href="/admin/assets/css/jquery-accordion-menu.css" rel="stylesheet" type="text/css" />
  <link href="/admin/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
  *{box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;}
  body{background:#f0f0f0;}
  .content{width:260px;margin:100px auto;}
  .filterinput{
    background-color:rgba(249, 244, 244, 0);
    border-radius:15px;
    width:90%;
    height:30px;
    border:thin solid #FFF;
    text-indent:0.5em;
    font-weight:bold;
    color:#FFF;
  }
  #demo-list a{
    overflow:hidden;
    text-overflow:ellipsis;
    -o-text-overflow:ellipsis;
    white-space:nowrap;
    width:100%;
  }
  .contentt{
    margin-top: 0;
  }
  .mar100{
    margin-bottom: 100px;
  }
  </style>

  <script src="/admin/assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
  <script src="/admin/assets/js/jquery-accordion-menu.js" type="text/javascript"></script>
  <script type="text/javascript">
  jQuery(document).ready(function () {
    jQuery("#jquery-accordion-menu").jqueryAccordionMenu();

  });

  $(function(){
    //顶部导航切换
    $("#demo-list li").click(function(){
      $("#demo-list li.active").removeClass("active")
      $(this).addClass("active");
    })
  })
  </script>
  </head>
  <body>
  <div class="content contentt">

    <div id="jquery-accordion-menu" class="jquery-accordion-menu mar100 red">
      <div class="jquery-accordion-menu-header" id="form"></div>
      <ul id="demo-list">
        <li><a href="#"><i class="fa fa-cog"></i>Services </a>
          <ul class="submenu">
            <li><a href="#">Web Design </a></li>
            <li><a href="#">Hosting </a></li>
            <li><a href="#">Design </a>
              <ul class="submenu">
                <li><a href="#">Graphics </a></li>
                <li><a href="#">Vectors </a></li>
                <li><a href="#">Photoshop </a></li>
                <li><a href="#">Fonts </a></li>
              </ul>
            </li>
            <li><a href="#">Consulting </a></li>
          </ul>
        </li>
      </ul>
      <div class="jquery-accordion-menu-footer">
        Footer
      </div>

    </div>
      <div class="am-panel am-panel-default admin-sidebar-panel">
          <div class="am-panel-bd">
              <p><span class="am-icon-bookmark"></span> 公告</p>
              <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
          </div>
      </div>

      <div class="am-panel am-panel-default admin-sidebar-panel">
          <div class="am-panel-bd">
              <p><span class="am-icon-tag"></span> wiki</p>
              <p>Welcome to the Amaze UI wiki!</p>
          </div>
      </div>
  </div>
</div>
  <script type="text/javascript">
  (function($) {
  $.expr[":"].Contains = function(a, i, m) {
    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
  };
  function filterList(header, list) {
    //@header 头部元素
    //@list 无需列表
    //创建一个搜素表单
    var form = $("<form>").attr({
      "class":"filterform",
      action:"#"
    }), input = $("<input>").attr({
      "class":"filterinput",
      type:"text"
    });
    $(form).append(input).appendTo(header);
    $(input).change(function() {
      var filter = $(this).val();
      if (filter) {
        $matches = $(list).find("a:Contains(" + filter + ")").parent();
        $("li", list).not($matches).slideUp();
        $matches.slideDown();
      } else {
        $(list).find("li").slideDown();
      }
      return false;
    }).keyup(function() {
      $(this).change();
    });
  }
  $(function() {
    filterList($("#form"), $("#demo-list"));
  });
  })(jQuery);
  </script>

  </body>
  </html>


<!-- sidebar end -->
</body>
</html>
