<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>[
      </button>
      <a class="navbar-brand" href="#">Wejoy</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="热搜榜">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href={{url('home/index')}}><span class="glyphicon glyphicon glyphicon-th" aria-hidden="true"></span> 首页</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> 发现</a></li>
        @if(Session::has('UserId'))
          <li>
            <a href="#">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              {{Session::get('UserNickname')}}
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-envelope"></span><span class="badge">4</span></a>
            <ul class="dropdown-menu">
              <li><a href="#">@我的</a></li>
              <li><a href="#">评论</a></li>
              <li><a href="#">赞</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">私信</a></li>
              <li><a href="#">未关注私信</a></li>
              <li><a href="#">群通知</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">信息设置</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a>
            <ul class="dropdown-menu">
              <li><a href={{url('home/set')}}>账号设置</a></li>
              <li><a href="#">会员中心</a></li>
              <li><a href="#">v认证</a></li>
              <li><a href="#">账号安全</a></li>
              <li><a href="#">隐私设置</a></li>
              <li><a href="#">屏蔽设置</a></li>
              <li><a href="#">信息设置</a></li>
              <li><a href="#">帮助中心</a></li>
              <li role="separator" class="divider"></li>
              <li><a href={{url('home/index/doLogout')}}>退出</a></li>
            </ul>
          </li>
          @else
          <li><a href="">注册</a></li>
          @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
