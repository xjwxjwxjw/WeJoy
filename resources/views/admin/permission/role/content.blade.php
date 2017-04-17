<script src={{url("/admin/js/role_app.js")}}></script>
<!-- content start -->
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
              <button type="button" id="add" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
            </div>

            <div class="am-form-group am-margin-left am-fl">
              <select>
                <option value="option1">所有类别</option>
                <option value="option2">IT业界</option>
                <option value="option3">数码产品</option>
                <option value="option3">笔记本电脑</option>
                <option value="option3">平板电脑</option>
                <option value="option3">只能手机</option>
                <option value="option3">超极本</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field">
                <span class="am-input-group-btn">
                  <button class="am-btn am-btn-default" type="button">搜索
                    @if(count($errors))
                      {{$errors->all()}}
                    @endif
                  </button>
                </span>
          </div>
        </div>
      </div>
    </div>

    <div class="am-g">
      <div class="am-u-sm-12">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">权限路由</th><th class="table-type">权限名称</th><th class="table-author">权限描述</th><th class="table-author">角色权限</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody id="task-list">
            @if(empty($roles))
            <tr><td>无数据</td></tr>
            @else
            @foreach ($roles as $role)
              <tr id="task{{ $role->id }}">
                <td><input type="checkbox" /></td>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td>{{$role->perms}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn test am-btn-default am-btn-xs am-text-secondary attachPermission" value="{{$role->id}}"><span class="am-icon-pencil-square-o"></span> 分配权限</button>
                      <button class="am-btn edit am-btn-default am-btn-xs am-text-secondary" value="{{$role->id}}"><span class="am-icon-pencil-square-o"></span> 修改</button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger delete" value="{{$role->id}}"><span class="am-icon-trash-o"></span> 删除</button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            @endif
          </tbody>
        </table>
          <div class="am-cf">
            共 15 条记录
             <nav aria-label="...">
               {{$roles->links('admin/permission/role.page')}}
            </nav>
          </div>
          <hr />
      </div>
    </div>
  </div>
  <!-- Large roles add and edit modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">添加权限</h4>
          {{$errors->first('name')}}
        </div>
        <div class="modal-body">
          <form action=''  method="post" id="testform">
            {{csrf_field()}}
            <div class="form-group">
              <label for="recipient-name" class="control-label">角色：</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label" >权限描述：</label>
              <textarea class="form-control" name="display_name" id="content"></textarea>
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label" >描述：</label>
              <textarea class="form-control" name="description" id="content2"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn" >Send message</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Large permission modal start -->
  <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">分配权限</h4>
        </div>
        <div class="modal-body">
          <form action=''  method="post" id="formrole">
            {{csrf_field()}}
            <div class="form-group row" id ="froles">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnrole" >Send message</button>
        </div>
      </div>
    </div>
  </div>
  <!-- large modal end -->
<!-- </div> -->
  <!-- content end -->
</body>
</html>
