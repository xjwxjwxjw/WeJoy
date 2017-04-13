<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/admin/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/admin/font/css/font-awesome.min.css">
    <script type="text/javascript" src="/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/admin/js/ch-ui.admin.js"></script>
    <?php echo $__env->yieldContent('my-css'); ?>
</head>
<body>
<!--头部 开始-->
<div class="top_box">
    <div class="top_left">
        <div class="logo">后台管理模板</div>
        <ul>
            <li><a href="/admin/index" class="active">首页</a></li>
            <li><a href="#">管理页</a></li>
        </ul>
    </div>
    <div class="top_right">
        <ul>
            <li>管理员：admin</li>
            <li><a href="pass.html" target="main">修改密码</a></li>
            <li><a href="#">退出</a></li>
        </ul>
    </div>
</div>
<!--头部 结束-->
<!--左侧导航 开始-->
<div class="menu_box">
    <ul>
        <li>
            <h3><i class="fa fa-fw fa-clipboard"></i>权限管理</h3>
            <ul class="sub_menu">
                <li><a href="/permission-list"><i class="fa fa-fw fa-list-ul"></i>权限管理</a></li>
                <li><a href="/role-list"><i class="fa fa-fw fa-list-alt"></i>角色管理</a></li>
                <li><a href="/user-list"><i class="fa fa-fw fa-plus-square"></i>管理员管理</a></li>
            </ul>
        </li>
    </ul>
</div>
<!--左侧导航 结束-->
<!--主体部分 开始-->
<div class="main_box">
   <?php echo $__env->yieldContent('content'); ?>
</div>
<!--主体部分 结束-->

<!--底部 开始-->
<div class="bottom_box">
    CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
</div>
<!--底部 结束-->
<?php echo $__env->yieldContent('my-js'); ?>
</body>
</html>