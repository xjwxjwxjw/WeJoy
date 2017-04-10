<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户信息</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/toastr.js/2.1.3/toastr.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/2.1.3/toastr.min.js"></script>
    <script src="{{ asset('js/user_app.js') }}"></script>
    <style>
        .table{margin: 50px auto;width: 90%;}
        .table,.table th{text-align: center}
        .table caption{text-align: center;font-size: 40px;}
        .selfError{color: red;}
    </style>
</head>
<body>
<table class='table table-striped table-bordered table-hover'>
    <caption>用户列表<br>
        {{--<a href="{!!url('/admin/myIndex/add')!!}" class="btn btn-warning">添加用户</a><!-- 完成删除 -->--}}
        <button class="btn btn-warning" id="add">添加用户</button>
    </caption>
    <tr class='success'>
        <th>id</th>
        <th>name</th>
        <th>pwd</th>
        <th>sex</th>
        <th>phone</th>
        <th>email</th>
        <th>address</th>
        <th>icon</th>
        <th>birthday</th>
        <th>status</th>
        <th>regtime</th>
        <th>DoWork</th>
    </tr>
    @foreach($result as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->pwd}}</td>
            <td>{{$value->sex}}</td>
            <td>{{$value->phone}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->address}}</td>
            <td>{{$value->icon}}</td>
            <td>{{$value->birthday}}</td>
            <td>{{$value->status}}</td>
            <td>{{$value->regtime}}</td>
            <td>
                {{--<a href="{!!url('/admin/myIndex/edit/'.$value->id)!!}" class="btn btn-info">修改</a><!-- 完成删除 -->--}}
                {{--<a href="{!!url('/admin/myIndex/del/'.$value->id)!!}" class="btn btn-danger">删除</a><!-- 完成删除 -->--}}
                <button  class="btn btn-info edit" value="{{ $value->id }}">编辑</button>
                <button class="btn btn-danger delete" value="{{ $value->id }}">删除</button>
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
                            <label for="exampleInputName">用户名：<span class="selfError"></span></label>
                            <input type="text" class="form-control" id="exampleInputName" placeholder="Please enter your name" name="name" value="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">密码：<span class="selfError"></span></label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please enter your password" name="password" value="" autocomplete="off" maxlength="18">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">确认密码：<span class="selfError"></span></label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Please enter password again" name="password_confirmation" value="" autocomplete="off" maxlength="18">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSex">性别：</label>
                            <label><input type="radio" id="exampleInputSex1" name="sex" value="1">男</label>
                            <label><input type="radio" id="exampleInputSex2" name="sex" value="2">女</label>
                            <label><input type="radio" id="exampleInputSex3" name="sex" value="3" checked>保密</label>
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
</body>
</html>
