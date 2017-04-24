    <!-- content start -->
    <script src="{{ asset('admin/js/user_app.js') }}"></script>
    <!-- <div id="slide-target"> -->
    <div class="admin-content" id="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户表</strong> / <small>Table</small></div>
        </div>

        <div class="am-g">
            <div class="am-u-md-6 am-cf">
                <div class="am-fl am-cf">
                    <div class="am-btn-toolbar am-fl">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" id="add" class="am-btn am-btn-default" id="add">
                                <span class="am-icon-plus"></span> 新增
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-u-md-3 am-cf">
                <div class="am-fr">
                    <div class="am-input-group am-input-group-sm">
                        <form action={{url('/admin/user')}} method="get">
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
                <table class='table table-striped table-bordered table-hover'>
                    <tr class='success'>
                        <th>id</th>
                        <th>name</th>
                        <th>truename</th>
                        <th>sex</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>QQ</th>
                        <th>address</th>
                        <th>icon</th>
                        <th>birthday</th>
                        <th>confirmed_code</th>
                        <th>status</th>
                        <th>create time</th>
                        <th>DoWork</th>
                    </tr>
                    @foreach($tasks as $value)
                        <tr>
                            <td>{{$value->uid}}</td>
                            <td>{{$value->nickname}}</td>
                            <td>{{$value->truename}}</td>
                            <td>{{$value->sex==1?'男':($value->sex==2?'女':'保密')}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->qq}}</td>
                            <td>{{$value->address}}</td>
                            <td>
                                <img src="{{url(empty($value->icon)?'/home/image/default.jpg':'/'.$value->icon)}}" style="width: 50px;height: 50px;">
                            </td>
                            <td>{{$value->birthday}}</td>
                            <td>{{$value->confirmed_code}}</td>
                            <td>
                                <a href="javascript:void(0)" class="changeStatus_btn btn {{$value->is_confirmed==1?'btn-success':'btn-danger'}}" style="opacity: 0.8">{{$value->is_confirmed==1?'已激活':'已禁用'}}</a>
                            </td>
                            <td>{{$value->create_time}}</td>
                            <td>
                                <button  class="btn btn-info edit" value="{{$value->uid }}">编辑</button>
                                <button class="btn btn-danger delete" value="{{$value->uid }}">删除</button>
                            </td>
                        </tr>

                    @endforeach
                    {{--Modal--}}
                    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
                                    <h4 class="modal-title" id="task-title">编辑用户</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="task" onsubmit="return false;" action="{{ url('admin/user/doEdit') }}" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName"><b style="color: red">*</b>用户名：<span class="selfError"></span></label>
                                            <input type="text" class="form-control" id="exampleInputName" placeholder="Please enter your name" name="name" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"><b style="color: red">*</b>密码：<span class="selfError"></span></label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please enter your password" name="password" value="" autocomplete="off" maxlength="18">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword2"><b style="color: red">*</b>确认密码：<span class="selfError"></span></label>
                                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Please enter password again" name="password_confirmation" value="" autocomplete="off" maxlength="18">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputSex">性别：</label>
                                            <label><input type="radio" id="exampleInputSex1" name="sex" value="1">男</label>
                                            <label><input type="radio" id="exampleInputSex2" name="sex" value="2">女</label>
                                            <label><input type="radio" id="exampleInputSex3" name="sex" value="3" checked>保密</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTruename">真实姓名：<span class="selfError"></span></label>
                                            <input type="text" class="form-control" id="exampleInputTruename" placeholder="Please enter your truename" name="truename" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPhone">手机号码：<span class="selfError"></span></label>
                                            <input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" class="form-control" id="exampleInputPhone" placeholder="Please enter your Phone" name="phone" value="" autocomplete="off" maxlength="11">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail">邮箱：<span class="selfError"></span></label>
                                            <input type="text" class="form-control" id="exampleInputEmail" placeholder="Please enter your email" name="email" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputQQ">QQ：<span class="selfError"></span></label>
                                            <input type="text" class="form-control" id="exampleInputQQ" placeholder="Please enter your qq number" name="qq" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAddress">住址：<span class="selfError"></span></label>
                                            <input type="text" class="form-control" id="exampleInputAddress" placeholder="Please enter your address" name="address" value="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputBirthday">生日：<span class="selfError"></span></label>
                                            <input type="date" class="form-control" id="exampleInputBirthday" name="birthday" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">头像上传：</label>
                                            <input type="file" id="exampleInputFile" name="icon">
                                        </div>
                                        {!! csrf_field() !!}
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="tsave" value="update">提交</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
                <div class="am-cf">
                    <nav aria-label="...">
                        @if( !empty($keepsearch) )
                            {{$tasks->appends(['search' => $keepsearch])->links('admin/user.page')}}
                        @else
                            {{$tasks->links('admin/user.page')}}
                        @endif
                    </nav>
                </div>
                <hr />
            </div>
        </div>
    </div>
</body>
</html>
