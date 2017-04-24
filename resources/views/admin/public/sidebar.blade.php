<!-- sidebar start -->
<div class="admin-sidebar">
  <link href="/admin/css/jquery-accordion-menu.css" rel="stylesheet" type="text/css" />
  <link href="/admin/css/font-awesome.css" rel="stylesheet" type="text/css" />
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

  <script src="/admin/js/jquery-accordion-menu.js" type="text/javascript"></script>
  <script type="text/javascript">
  jQuery(document).ready(function () {
    jQuery("#jquery-accordion-menu").jqueryAccordionMenu();

  });

  </script>
  </head>
  <body>
  <div id="admin-slide" class="content contentt">

    <div id="jquery-accordion-menu" class="jquery-accordion-menu mar100 red">
      <div class="jquery-accordion-menu-header" id="form"></div>
      <ul id="demo-list">
        <!-- 侧边栏菜单 -->
        <li><a href="#"><i class="fa fa-cog"></i>信息管理 </a>
          <ul class="submenu">
            <li><a href={{url('admin/new')}}>查看微博 </a></li>
            <li class="edit"><a href={{url('admin/newtype')}}>微博分类 </a></li>
          </ul>
        </li>
        <li><a href="#"><i class="fa fa-cog"></i>权限管理 </a>
              <ul class="submenu">
                  <li><a href={{url('admin/permission/permission')}}>权限管理 </a></li>
                  <li><a href={{url('admin/permission/role')}}>角色管理 </a></li>
                  <li class="edit"><a href={{url('admin/permission/adminuser')}}>管理员管理 </a></li>
              </ul>
          </li>
          <li><a href="#"><i class="fa fa-cog"></i>用户管理 </a>
              <ul class="submenu">
                  <li><a href={{url('admin/user')}}>查看用户 </a></li>
              </ul>
          </li>
          <li><a href="#"><i class="fa fa-cog"></i>前台系统管理 </a>
              <ul class="submenu">
                  <li><a href={{url('admin/AboutUs')}}>关于我们 </a></li>
              </ul>
          <li><a href="#"><i class="fa fa-cog"></i>友情链接管理 </a>
            <ul class="submenu">
              <li><a href={{url('admin/new')}}>友情链接 </a></li>
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
