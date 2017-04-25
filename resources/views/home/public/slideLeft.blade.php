<div>
    <ul id='slideleft' class="slideleft MJ_slideleft">
    @if(Cookie::has('UserId'))
           <a href={{url('home/index')}}><li>首页<span class="glyphicon glyphicon-repeat bg1 right"></span></li></a>
           <li id='mycollect'>我的收藏</li>
           <li id='myfavtimes'>我的赞</li>
            <fieldset></fieldset>
            <li><span class="glyphicon glyphicon-fire"></span> 热门微博<span class="glyphicon glyphicon-repeat bg1 right"></span></li>
            <fieldset></fieldset>
   @endif
      @foreach( $newtype as $v )
           <li class='newstype' title='{{$v}}'><span class="glyphicon glyphicon-record"></span> {{$v}} {{--<span class="WJbadge">42</span>--}}</li>
      @endforeach

       </ul>
</div>
