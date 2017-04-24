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
        $('#infor').val('');
        $('#service').val('');
        $('#advantage').val('');
        $('#contact').val('');
        $('#infor').text('');
        $('#service').text('');
        $('#advantage').text('');
        $('#contact').text('');
        $('#error_span').text('');
    });
    $('#add').click(function () {
        //检测是否有数据  有则不能添加
        if ($('#about_table').children('tbody').children('tr:last-child').attr('id') == 'noabout'){
            $('#exampleModalLabel').text('添加信息');
            $('#myModal').modal('show');
            var $div = $('#myModal').children('.modal-dialog').children('.modal-content').children('.modal-body').children('form').children('div');
            for(var a = 0 ; a < $div.length;a++){
                $($div[a]).prop('style','');
            }
        }
    });
    //删除按钮
    $('body').on('click', 'button.delete', function() {
        var $click = $(this).parents('tr').children('td:first').text();
        $.ajax({
            type: 'get',
            url: '/admin/AboutUsDelete',
            data:'name='+$click,
            success: function (data) {
                toastr.success('删除成功！');
            },
            error: function (data, json, errorThrown) {
                toastr.success('删除失败，请刷新重试');
            }
        });
    });
    //查询被编辑用户
    $('body').on('click', 'button.edit', function() {
        $('#submit_btm').attr('disabled',true);
        var $click = $(this).parents('tr').children('td:first').text();
        $content = $(this).parents('td')[0].previousElementSibling.innerText;
        var $div = $('#myModal').children('.modal-dialog').children('.modal-content').children('.modal-body').children('form').children('div');
        for(var a = 0 ; a < $div.length;a++){
            $($div[a]).prop('style','');
        }
        $('#exampleModalLabel').text('修改信息');
        $('#myModal').modal('show');
        for(var a = 0 ; a < $div.length;a++){
            if ($($div[a]).attr('id') != $click+"_div"){
                $($div[a]).prop('style','display:none');
                $($div[a]).attr('isLook','');
            }else{
                $($div[a]).attr('isLook','yes');
                $($div[a]).children('textarea').text($content);
            }
        }

        window.onkeydown = function () {
            var $div = $('#myModal').children('.modal-dialog').children('.modal-content').children('.modal-body').children('form').children('div');
            for(var a = 0 ; a < $div.length;a++){
                if ($($div[a]).attr('isLook') == 'yes'){
                    var $_this = $($div[a]);
                }
            }
            console.log($content);
            if ($_this.children('textarea').val() == $content){
                $('#submit_btm').attr('disabled',true);
            }else{
                $('#submit_btm').attr('disabled',false);
            }
        }
    });
    //提交按钮
    $('#submit_btm').click(function () {
        if ($('#exampleModalLabel')[0].innerText == '添加信息') {
            var turl = '/admin/AboutUsadd';
            //验证数据
            var $div = $('#myModal').children('.modal-dialog').children('.modal-content').children('.modal-body').children('form').children('div');
            var nullnum = 0;
            for (var i = 0 ; i < $div.length ; i++){
                if ($($div[i]).children('textarea').val() == null || $($div[i]).children('textarea').val() == ''){
                    nullnum++;
                }
            }
            if (nullnum >= 4){
                //是否为空
                $('#error_span').text('以上字段至少填写一位');
                return;
            }else{
                $.ajax({
                    url:turl,
                    data:$('#myModal').children('.modal-dialog').children('.modal-content').children('.modal-body').children('form').serialize(),
                    type:'post',
                    success:function (backString) {
                        if (backString != 1){
                            toastr.success('添加失败，请刷新重试');
                        }else{
                            toastr.success('添加成功！');
                            location.reload().delay(3000);
                        }
                    },
                    error:function () {
                        toastr.success('添加失败，请刷新重试');
                    }
                })
            }
        }else if($('#exampleModalLabel')[0].innerText == '修改信息') {
            var turl = '/admin/AboutUsUp';
            $.ajax({
                url:turl,
                data:$('#myModal').children('.modal-dialog').children('.modal-content').children('.modal-body').children('form').serialize(),
                type:'post',
                success:function (backString) {
                    if (backString != 1){
                        toastr.success('修改失败，请刷新重试');
                    }else {
                        toastr.success('修改成功！');
                        location.reload().delay(3000);
                    }
                },
                error:function () {
                    toastr.success('修改失败，请刷新重试');
                }
            })
        }else{
            alert('不要太跳哦！！');
            location.reload();
        }


    })

});