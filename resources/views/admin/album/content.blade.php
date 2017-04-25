  <!-- content start -->
  <script src={{url("/admin/js/album_app.js")}}></script>
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
            </div>
          </div>
        </div>
      </div>
      <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm">
          </div>
        </div>
      </div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
          <table class="am-table am-table-striped am-table-hover table-main">
              <tr>
                <th class="table-id">ID</th>
                <th class="table-id">user name</th>
                <th class="table-title">AlbumName</th>
                <th class="table-type">AlbumDescription</th>
                <th class="table-author">AlbumPermissions</th>
                <th class="table-date">CreateTime</th>
                <th class="table-set">操作</th>
              </tr>
            @if(empty($tasks))
              <tr><td colspan="8">无数据</td></tr>
            @else
            @foreach ($tasks as $v)
              <tr id="task{{ $v->Aid }}">
                <td>{{ $v->Aid }}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->AlbumName}}</td>
                <td>{{$v->AlbumDescription}}</td>
                <td>{{$v->AlbumPermissions==1?'公开':($v->AlbumPermissions==2?'权限':'隐私')}}</td>
                <td>{{empty($v->CreateTime)?'':date("Y年m月d日 H:i:s",$v->CreateTime)}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn edit am-btn-default am-btn-xs am-text-secondary" value="{{$v->Aid}}" onclick="editalbum(this)"><span class="glyphicon glyphicon-pencil"></span>修改</button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger delete" value="{{$v->Aid}}" onclick="ablumdel(this)"><span class="am-icon-trash-o"></span> 删除</button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            @endif
        </table>
          <div class="am-cf">
             <nav aria-label="...">
                {{$tasks->links()}}
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
          <h4 class="modal-title" id="exampleModalLabel">修改相册</h4>
        </div>
        <div class="modal-body">
          <form id="editAlbum_form">
            <div class="form-group">
              <input type="hidden" name="id" value="" id="getAid">
              <label for="recipient-name" class="control-label">名字:</label>
              <input type="text" class="form-control" id="topic" name="AlbumName" value="">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label" >描述:</label>
              <textarea class="form-control" id="content" name="AlbumDescription"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="albumsubmit(this)">确定</button>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
  <!-- content end -->
</body>
</html>
