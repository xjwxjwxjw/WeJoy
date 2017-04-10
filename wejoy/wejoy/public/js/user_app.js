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
        $('#exampleInputName').val('');
        $('#exampleInputPassword1').parents('.form-group').attr('style',false);
        $('#exampleInputPassword2').parents('.form-group').attr('style',false);
        $('#exampleInputSex3').attr('checked',true);
        $('#exampleInputPhone').val('');
        $('#exampleInputEmail').val('');
        $('#exampleInputAddress').val('');
        $('#exampleInputBirthday').val('');
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
                data = data[0];
                $('#exampleInputName').val(data.name);
                $('#exampleInputPassword1').parents('.form-group').attr('style','display:none');
                $('#exampleInputPassword2').parents('.form-group').attr('style','display:none');
                $('#exampleInputSex'+data.sex).attr('checked',true);
                $('#exampleInputPhone').val(data.phone);
                $('#exampleInputEmail').val(data.email);
                $('#exampleInputAddress').val(data.address);
                $('#exampleInputBirthday').val(data.birthday);
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
        //验证之前将所有提示span内容清空

        if(!regName.test($('#exampleInputName').val())){
            //验证用户名
            $('#exampleInputName')[0].previousElementSibling.firstElementChild.innerText = '用户名不能为空';
            return;
        }else if(!regPwd.test($('#exampleInputPassword1').val()) && $('#exampleInputPassword1').parents('.form-group').attr('style') != 'display:none'){
            //验证密码  //上面判断的是验证规则  和  密码框存在
            $('#exampleInputPassword1')[0].previousElementSibling.firstElementChild.innerText = '密码至少为6位';
            return;
        }else if($('#exampleInputPassword1').val() != $('#exampleInputPassword2').val() && $('#exampleInputPassword1').parents('.form-group').attr('style') != 'display:none' && $('#exampleInputPassword2').parents('.form-group').attr('style') != 'display:none'){
            //验证再次密码  //上面判断的是验证相同  和  密码框存在
            $('#exampleInputPassword2')[0].previousElementSibling.firstElementChild.innerText = '两次密码输入不一致';
            return;
        }
        //无错 则开启提交模式
        $('#task').attr('onsubmit','');
    })
});