  <!-- content start -->
  <script src={{url("/admin/js/advert_app.js")}}></script>
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
              <button type="button" id="add" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增分类</button>
              <button type="button" disabled=true disabled=true class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
              <button type="button" disabled=true disabled=true class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
              <button type="button" disabled=true disabled=true class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          </div>
        </div>
      </div>
      <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm">
            <form action={{url('/admin/newtype')}} method="get">
              <input style="width:179px;height:36px;" name="search" type="text" class="searchval am-form-field">
                  <span class="am-input-group-btn">
                    <input style="height:36px;width:56px;font-size: 1.4rem;" class="am-btn search am-btn-default" type="submit" value="搜索">
                  </span>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">广告商名</th><th class="table-title">图片链接</th><th class="table-title">广告链接</th><th class="table-date">发布日期</th><th class="table-date">修改日期</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody id="task-list">
            @if(empty($tasks))
            <tr><td>无数据</td></tr>
            @else
            @foreach ($tasks as $v)
              <tr id="task{{ $v->id }}">
                <td><input type="checkbox" /></td>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td><span style="width:200px;" class="my-con" title="{{$v->src}}">{{$v->src}}</span></td>
                <td><span style="width:200px;" class="my-con" title="{{$v->url}}">{{$v->url}}</span></td>
                <td>{{$v->created_at}}</td>
                <td>{{$v->updated_at}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn edit am-btn-default am-btn-xs am-text-secondary" value="{{$v->id}}"><span class="am-icon-pencil-square-o"></span> 修改 </button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger delete" value="{{$v->id}}"><span class="am-icon-trash-o"></span> 删除</button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            @endif
          </tbody>
        </table>
          <div class="am-cf">
             <nav aria-label="...">
               @if( !empty($keepsearch) )
                {{$tasks->appends(['search' => $keepsearch])->links('admin/advert.page')}}
               @else
                {{$tasks->links('admin/advert.page')}}
               @endif
            </nav>
          </div>
          <hr />
      </div>
    </div>
  </div>
  <!-- Large modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">添加分类</h4>
        </div>
        <div class="modal-body">
          <form action={{url('admin/advert/advert-add')}}  method="post" id="testform2" enctype="multipart/form-data" >
            {{csrf_field()}}
            <div class="form-group">
              <label for="recipient-name" class="control-label">广告名：</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="control-label">广告链接：</label>
              <input type="text" class="form-control" name="url">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="control-label">广告图片：</label>
              <input type="file" class="form-control" name="src">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" id="btn" class="btn btn-default" value="Send message">
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- </div> -->

<!-- Large modal -->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">添加分类</h4>
      </div>
      <div class="modal-body">
        <form action={{url('admin/advert/advert-update')}}  method="post" id="testform" enctype="multipart/form-data" >
          {{csrf_field()}}
          <div class="form-group">
            <label for="recipient-name" class="control-label">广告名：</label>
            <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">广告链接：</label>
            <input type="text" class="form-control" name="url" id="url">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">广告图片：</label>
            <input type="file" class="form-control" name="src" id="src">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" id="btns" class="btn btn-default" value="Send message">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- </div> -->
  <!-- content end -->
</body>
</html>
