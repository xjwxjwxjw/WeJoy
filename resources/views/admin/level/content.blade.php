  <!-- content start -->
  <script src={{url("/admin/js/level_app.js")}}></script>
<!-- <div id="slide-target"> -->
  <div class="admin-content" id="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">表格</strong> / <small>Table</small></div>
    </div>

    <div class="am-g">
      <div class="am-u-md-6 am-cf">
        <div class="am-fl am-cf">
          <div class="am-btn-toolbar am-fl">
            <div class="am-btn-group am-btn-group-xs">
              <form id="exp_form" class="form-inline">
                <div class="form-group">
                  <label for="exampleInputExp">请输入要修改的经验值：</label>
                  <input name="exp" type="text" value="5" class="form-control" id="exampleInputExp" onkeyup="aaa(this)" maxlength="4">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm">
            <form action={{url('/admin/level')}} method="get" id="search_form">
              <input style="width:179px;height:36px;" name="search" type="text" class="searchval am-form-field">
              <span class="am-input-group-btn">
                    <input style="height:36px;width:56px;font-size: 1.4rem;" class="am-btn search am-btn-default" type="submit" value="搜索">
                  </span>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="am-g" style="margin-top: 10px">
      <div class="am-u-sm-12">
          <table class="am-table am-table-striped am-table-hover table-main">
              <tr>
                <th style="width: 5%;"></th>
                <th class="table-id" style="width: 20%;">user name</th>
                <th class="table-title" style="width: 20%;">experience</th>
                <th class="table-type" style="width: 20%;">level</th>
                <th class="table-set" style="width: 20%;">操作</th>
              </tr>
            @if(empty($tasks))
              <tr><td colspan="8">无数据</td></tr>
            @else
            @foreach ($tasks as $v)
              <tr id="task{{ $v->Lid }}">
                <td></td>
                <td id="name_div">{{$v->name}}</td>
                <td id="exp_div">{{$v->exp}}</td>
                <td id="level_div">Lv.{{$v->level}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn edit am-btn-default am-btn-xs am-text-secondary" value="{{$v->Lid}}" onclick="addexp(this)"><span class="glyphicon glyphicon-plus"></span></button>
                      <div class="getExpValue" style="display: inline-block;position: relative;float: left;width: 37px;border: 1px solid #ccc;height: 31px;text-align: center;line-height: 31px;">5</div>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger delete" value="{{$v->Lid}}" onclick="minusexp(this)"><span class="glyphicon glyphicon-minus"></span></button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            @endif
        </table>
          <div class="am-cf">
             <nav aria-label="...">
               @if( !empty($keepsearch) )
                 {{$tasks->appends(['search' => $keepsearch])->links()}}
               @else
                 {{$tasks->links()}}
               @endif
            </nav>
          </div>
          <hr />
      </div>
    </div>
  </div>
  <!-- content end -->
</body>
</html>
