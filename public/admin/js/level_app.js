var aaa = function (obj) {
    //禁止输入非数字
    $(obj).val($(obj).val().replace(/[^\d]/g,''));
    //+ - 之间显示数字
    $('.getExpValue').text($(obj).val());
}
var addexp = function (obj) {
    var oldexp = $(obj).parents('tr').children('#exp_div').text();
    var addexp = $($('#exp_form #exampleInputExp')).val();
    var newlevel = Math.ceil((eval(oldexp+'+'+addexp)) / 50);
    $.ajax({
        url: '/admin/level/add',
        data: 'id=' + $(obj).attr('value')+'&'+$('#exp_form').serialize(),
        type: 'get',
        success: function (error) {
            if (error == 1) {
                toastr.success('加经验成功');
                $(obj).parents('tr').children('#exp_div').text(eval(oldexp+'+'+addexp));
                $(obj).parents('tr').children('#level_div').text('Lv.'+newlevel);
            } else {
                toastr.error('加经验失败');
            }
        },
        error: function () {
            toastr.error('加经验失败');
        }
    });
};
var minusexp = function (obj) {
    var oldexp = $(obj).parents('tr').children('#exp_div').text();
    var addexp = $($('#exp_form #exampleInputExp')).val();
    var newlevel = Math.ceil((eval(oldexp+'-'+addexp)) / 50);
    $.ajax({
        url: '/admin/level/minus',
        data: 'id=' + $(obj).attr('value')+'&'+$('#exp_form').serialize(),
        type: 'get',
        success: function (error) {
            if (error == 1) {
                toastr.success('惩罚经验成功');
                $(obj).parents('tr').children('#exp_div').text(eval(oldexp+'-'+addexp));
                $(obj).parents('tr').children('#level_div').text('Lv.'+newlevel);
            } else {
                toastr.error('惩罚经验失败');
            }
        },
        error: function () {
            toastr.error('惩罚经验失败');
        }
    });
}