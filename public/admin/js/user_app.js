$(document).ready(function () {
    function escapeHtml(string) {
        var entityMap = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            "/": '&#x2F;'
        };
        return String(string).replace(/[&<>"'\/]/g, function (s) {
            return entityMap[s];
        });
    }

    $('button.close').click(function(){
        //点击关闭  清除所有数据
        $('#exampleInputName').val('');
        $('#exampleInputPassword1').parents('.form-group').attr('style',false);
        $('#exampleInputPassword2').parents('.form-group').attr('style',false);
        $('#exampleInputSex3').attr('checked',true);
        $('#exampleInputPhone').val('');
        $('#exampleInputEmail').val('');
        $('#exampleInputAddress').val('');
        $('#exampleInputBirthday').val('');
        $('#exampleInputTruename').val('');
        $('#exampleInputQQ').val('');
        var span = document.getElementsByClassName('selfError');
        for(var i = 0 ; i < span.length ; i++){
            span[i].innerText = '';
        }
    });
    $('#add').click(function () {
        $('#task-title').text('添加用户');
        $('#tsave').val('add');
        $('#taskModal').modal('show');
        $('#task').attr('action','user/doAdd');
    });
    //删除按钮
    $('body').on('click', 'button.delete', function() {
        var tid = $(this).val();
        var $_this = $(this);
        $.ajax({
            type: 'get',
            url: 'user/doDel/'+tid,
            success: function (data) {
                $_this.parents('tr').remove();
                toastr.success('删除成功！');
            },
            error: function (data, json, errorThrown) {
                var errors = data.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);
            }
        });
    });
    //查询被编辑用户
    $('body').on('click', 'button.edit', function() {
        $('#task-title').text('编辑用户');
        $('#tsave').val('update');
        var tid = $(this).val();
        $('#task').attr('action','user/doEdit/'+tid);
        $.ajax({
            url: 'user/doFind/' + tid,
            type: 'get',
            success: function (data) {
                eval('var data = '+data);
                console.log(data);
                $('#exampleInputName').val(data[0][0].name);
                $('#exampleInputSex'+data[1][0].sex).prop('checked',true);
                $('#exampleInputTruename').val(data[1][0].name);
                $('#exampleInputQQ').val(data[1][0].qq);
                $('#exampleInputPhone').val(data[0][0].phone);
                $('#exampleInputEmail').val(data[0][0].email);
                $('#exampleInputAddress').val(data[1][0].address);
                $('#exampleInputBirthday').val(data[1][0].birthday);
            }
        });
        $('#taskModal').modal('show');
    });
    //添加、修改页面 的 提交按钮
    $('#tsave').click(function () {
        if ($('#task-title')[0].innerText == '添加用户') {
            var turl = location.hostname+'/admin/user/doAdd';
        }else if($('#task-title')[0].innerText == '编辑用户') {
            var turl = location.hostname+'/admin/user/doEdit';
        }else{
            alert('不要太跳哦！！');
            window.location = 'user';
            die;
        }
        for (var i = 0 ; i<$('.selfError').length ; i++){
            $('.selfError')[i].innerText = '';
        }
        //用户名、密码正则
        regName = /^([\u4e00-\u9fa5]|[0-9a-zA-Z_])+$/;
        regPwd = /^([0-9a-zA-Z_]){6,}$/;
        regPhone = /^1(3|4|5|7|8)\d{9}$/;
        regEmail = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
        //验证之前将所有提示span内容清空

        if(!regName.test($('#exampleInputName').val())){
            //验证用户名
            $('#exampleInputName')[0].previousElementSibling.lastElementChild.innerText = '用户名不能为空且只能输入汉子、字母、数字和下划线';
            return;
        }
        if(!regPwd.test($('#exampleInputPassword1').val()) && $('#exampleInputPassword1').parents('.form-group').attr('style') != 'display:none' && $('#task-title')[0].innerText == '添加用户'){
            //验证密码  //上面判断的是验证规则  和  密码框存在
            $('#exampleInputPassword1')[0].previousElementSibling.lastElementChild.innerText = '密码至少为6位';
            return;
        }
        if($('#exampleInputPassword1').val() != $('#exampleInputPassword2').val() && $('#exampleInputPassword1').parents('.form-group').attr('style') != 'display:none' && $('#exampleInputPassword2').parents('.form-group').attr('style') != 'display:none'){
            //验证再次密码  //上面判断的是验证相同  和  密码框存在
            $('#exampleInputPassword2')[0].previousElementSibling.lastElementChild.innerText = '两次密码输入不一致';
            return;
        }
        if(!regPhone.test($('#exampleInputPhone').val()) && $('#exampleInputPhone').val() != '' ){
            //验证手机
            $('#exampleInputPhone')[0].previousElementSibling.lastElementChild.innerText = '手机格式错误';
            return;
        }
        if(!regEmail.test($('#exampleInputEmail').val()) && $('#exampleInputEmail').val() != '' ){
            //验证邮箱
            $('#exampleInputEmail')[0].previousElementSibling.lastElementChild.innerText = '邮箱格式错误';
            return;
        }
        //无错 则开启提交模式
        $('#task').attr('onsubmit','');
    })
    //后台对前台用户激活禁用
    $('.changeStatus_btn').click(function () {
        var $_this = $(this);
        switch ($(this).text()){
            case '已激活':
                var id = $(this).parents('tr').children().first().text();
                var status = '1';
                $.ajax({
                    url:'/admin/user/changeStatus',
                    data:'id='+id+'&status='+status,
                    type:'get',
                    success:function () {
                        $_this.attr('class',"changeStatus_btn btn btn-danger");
                        $_this.text('已禁用');
                    },
                    error:function () {
                       location.reload()
                    }
                })
                break;
            case '已禁用':
                var id = $(this).parents('tr').children().first().text();
                var status = '0';
                $.ajax({
                    url:'/admin/user/changeStatus',
                    data:'id='+id+'&status='+status,
                    type:'get',
                    success:function () {
                        $_this.attr('class',"changeStatus_btn btn btn-success");
                        $_this.text('已激活');
                    },
                    error:function () {
                        location.reload()
                    }
                })
                break;
            default:
                location.reload();
                break;
        }
    })
});