
    var photodel = function (obj) {
        $.ajax({
            url: '/admin/photo/doDel',
            data: 'id=' + $(obj).attr('value'),
            type: 'get',
            success: function (error) {
                if (error == 1) {
                    toastr.success('删除成功');
                    location.reload();
                } else {
                    toastr.error('删除失败');
                }
            },
            error: function () {
                toastr.error('删除失败');
            }
        });
    };
    var editphoto = function (obj) {
        $('#topic').val($(obj).parents('tr').children('td:nth-child(4)').text());
        $('#content').val($(obj).parents('tr').children('td:nth-child(5)').text());
        $('#getAid').val($(obj).parents('tr').children('td:nth-child(1)').text());
        $('#myModal').modal('show');
        olddata = $('#editPhoto_form').serialize();
    }
    var photosubmit = function (obj) {
        var newdata = $('#editPhoto_form').serialize();
        if (olddata == newdata){
            toastr.error('数据未作修改');
        }else{
            $.ajax({
                url:'/admin/photo/doEdit',
                data:newdata,
                type:'get',
                success:function (error) {
                    if (error == 1){
                        toastr.success('修改成功');
                        location.reload();
                    }else{
                        toastr.error('修改失败');
                    }
                },
                error:function () {
                    toastr.error('修改失败');
                }
            })
        }
    }