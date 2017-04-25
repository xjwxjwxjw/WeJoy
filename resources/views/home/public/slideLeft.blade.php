<div>
    <ul id='slideleft' class="slideleft MJ_slideleft">
    @if(Cookie::has('UserId'))
           <a href={{url('home/index')}}><li>首页<span class="glyphicon glyphicon-repeat bg1 right"></span></li></a>
           <li id='mycollect'>我的收藏</li>
           <li id='myfavtimes'>我的赞</li>
            <fieldset></fieldset>
            <li><span class="glyphicon glyphicon-fire"></span> 热门微博<span class="glyphicon glyphicon-repeat bg1 right"></span></li>
            <fieldset></fieldset>
           <li>好友圈 {{--<span class="WJbadge">42</span>--}}</li>
           <li>特别关注 {{--<span class="WJbadge">42</span>--}}</li>
   @endif
           <li class='newstype' title='新闻趣事'><span class="glyphicon glyphicon-record"></span> 新闻趣事 {{--<span class="WJbadge">42</span>--}}</li>
           <li class='newstype' title="名人明星"><span class="glyphicon glyphicon-record"></span> 名人明星 {{--<span class="WJbadge">42</span>--}}</li>
           <li class='newstype' title="小说" ><span class="glyphicon glyphicon-record"></span> 小说 {{--<span class="WJbadge">42</span>--}}</li>
           <li class='newstype' title="旅游" ><span class="glyphicon glyphicon-record"></span> 旅游 {{--<span class="WJbadge">42</span>--}}</li>
           <li class='newstype' title="搞笑" ><span class="glyphicon glyphicon-record"></span> 搞笑 {{--<span class="WJbadge">42</span>--}}</li>
           <li class='newstype' title="设计" ><span class="glyphicon glyphicon-record"></span> 设计 {{--<span class="WJbadge">42</span>--}}</li>
        <a href="{{url('/home/AboutUs')}}"><li class="newstype" title="关于我们" ><span class="glyphicon glyphicon-record"></span>关于我们</li></a>
      @foreach( $newtype as $v )
           <li class='newstype' title='{{$v}}'><span class="glyphicon glyphicon-record"></span> {{$v}} {{--<span class="WJbadge">42</span>--}}</li>
      @endforeach

       </ul>
</div>
