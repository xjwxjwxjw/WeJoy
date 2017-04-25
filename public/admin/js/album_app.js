
    var ablumdel = function (obj) {
        $.ajax({
            url: '/admin/album/doDel',
            data: 'id=' + $(obj).parents('tr').attr('id').substr(4),
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
    var editalbum = function (obj) {
        $('#topic').val($(obj).parents('tr').children('td:nth-child(3)').text());
        $('#content').val($(obj).parents('tr').children('td:nth-child(4)').text());
        $('#getAid').val($(obj).parents('tr').children('td:nth-child(1)').text());
        $('#myModal').modal('show');
        olddata = $('#editAlbum_form').serialize();
    }
    var albumsubmit = function (obj) {
        var newdata = $('#editAlbum_form').serialize();
        if (olddata == newdata){
            toastr.error('数据未作修改');
        }else{
            $.ajax({
                url:'/admin/album/doEdit',
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