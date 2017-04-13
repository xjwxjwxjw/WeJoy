<script src={{url("/admin/js/adminuser_app.js")}}></script>
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
                  <button class="am-btn am-btn-default" type="button">搜索</button>
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
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">用户名</th><th class="table-type">邮箱</th><th class="table-author">角色名称</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody id="task-list">
            @if(empty($users))
            <tr><td>无数据</td></tr>
            @else
            @foreach ($users as $user)
              <tr id="task{{ $user->id }}">
                <td><input type="checkbox" /></td>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->roles}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn edit am-btn-default am-btn-xs am-text-secondary attachRole" value="{{$user->id}}"><span class="am-icon-pencil-square-o"></span> 分配角色</button>
                      <button class="am-btn edit am-btn-default am-btn-xs am-text-secondary" value="{{$user->id}}"><span class="am-icon-pencil-square-o"></span> 修改</button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger delete" value="{{$user->id}}"><span class="am-icon-trash-o"></span> 删除</button>
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
               {{$users->links('admin/permission/adminuser.page')}}
            </nav>
          </div>
          <hr />
      </div>
    </div>
  </div>
  <!-- Large user modal start -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">添加管理员</h4>
        </div>
        <div class="modal-body">
          <form action=''  method="post" id="formuser">
            {{csrf_field()}}
            <div class="form-group">
              <label for="recipient-name" class="control-label">用户名：</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label" >邮箱：</label>
              <input class="form-control" name="email" type="email" id="email">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label" >密码：</label>
              <input class="form-control" name="password" type="password" id="password">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label" >确认密码：</label>
              <input class="form-control" name="repassword" type="password" id="repassword">
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
  <!-- large modal end -->

  <!-- Large roles modal start -->
  <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">分配角色</h4>
        </div>
        <div class="modal-body">
          <form action=''  method="post" id="formrole">
            {{csrf_field()}}
            <div class="form-group row" id ="froles">
              {{$users->links('admin/permission/adminuser.page')}}
            </div
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
