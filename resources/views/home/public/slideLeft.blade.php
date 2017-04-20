<div>
 <ul id='slideleft' class="slideleft MJ_slideleft">
   <a href={{url('home/index')}}><li>首页<span class="glyphicon glyphicon-repeat bg1 right"></span></li></a>
   <li id='mycollect'>我的收藏</li>
   <li id='myfavtimes'>我的赞</li>
    <fieldset></fieldset>
   <li><span class="glyphicon glyphicon-fire"></span> 热门微博<span class="glyphicon glyphicon-repeat bg1 right"></li>
    <fieldset></fieldset>
   <li>好友圈 <span class="WJbadge">42</span></li>
   <li>特别关注 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 新闻趣事 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 名人明星 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 同学 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 明星 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 小说 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 旅游 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 搞笑 <span class="WJbadge">42</span></li>
   <li><span class="glyphicon glyphicon-record"></span> 有趣 <span class="WJbadge">42</span></li>
 </ul>
    <ul id='slideleft' class="slideleft MJ_slideleft">
    @if(Cookie::has('UserId'))
           <li>首页<span class="glyphicon glyphicon-repeat bg1 right"></span></li>
           <li id='mycollect'>我的收藏</li>
           <li id='myfavtimes'>我的赞</li>
            <fieldset></fieldset>
            <li><span class="glyphicon glyphicon-fire"></span> 热门微博<span class="glyphicon glyphicon-repeat bg1 right"></span></li>
            <fieldset></fieldset>
           <li>好友圈 {{--<span class="WJbadge">42</span>--}}</li>
           <li>特别关注 {{--<span class="WJbadge">42</span>--}}</li>
   @endif
           <li><span class="glyphicon glyphicon-record"></span> 新闻趣事 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 名人明星 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 同学 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 明星 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 小说 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 旅游 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 搞笑 {{--<span class="WJbadge">42</span>--}}</li>
           <li><span class="glyphicon glyphicon-record"></span> 有趣 {{--<span class="WJbadge">42</span>--}}</li>
       </ul>
</div>
