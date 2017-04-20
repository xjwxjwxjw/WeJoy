var npclick = function(obj){
    var _this = obj;
    //获取数据
    var parent = $(obj).parents('.W_login_form');
    var input = [];
    var a = 0;
    for(var i = 0;i < $(obj).parents('.W_login_form').find('input').length; i++){
        if($($(obj).parents('.W_login_form').find('input')[i]).prop('disabled') == true){
            a++;
            continue;
        }
        input[i-a] = $(obj).parents('.W_login_form').find('input')[i];
        //判断是否为空
        if ($(input[i-a]).val() == ''){
            $($('.W_login_form').children('.login_prompt')).attr('style','display:inline-block');
            $($($('.W_login_form').children('.login_prompt'))).children('div').text('用户名或密码不能为空');
            // $(input[i-a]).prop('placeholder','不能为空');
            return false;
        }
    }
    //将数据变为 k=v&k=v 的格式
    var data = {};
    for(var j = 0;j < input.length; j++){
        if ($(input[j]).prop('type') == 'checkbox' || $(input[j]).prop('type') == 'redio'){
            // 用于记住我  保存session和session对应的cookie
        }else{
            data[$(input[j]).prop('name')] =  $(input[j]).val() ;
        }
    }
    // data = data.substring(0,data.length-1);
    var tourl = location.href
//   传送数据  即添加数据
    $.ajax({
        url: tourl+'/doLogin',
        data:data,
        type:'post',
        success:function(error){
            if(isNaN(error)){
                $($('.login_btn').children('.W_btn_a')).attr('data-toggle','modal');
                $($('.login_btn').children('.W_btn_a')).attr('data-target','#myModal');
                window.location = tourl;
            }else{
                $($('.W_login_form').children('.login_prompt')).attr('style','display:inline-block');
                $($($('.W_login_form').children('.login_prompt'))).children('div').text('用户名或密码有误或账号未激活');
            }
        },
        error:function (error) {
            alert('登陆失败，刷新重试');
            // window.location = tourl;
        },
        dataType:'json'
    })

}
var registbtn = function (obj) {
    if(obj.innerText == '验证数据'){
        var input = document.getElementById('registform').getElementsByClassName('form-control');
        if($(input[0]).val() == ''){

        }
        //用户名、密码正则
        regName = /^([\u4e00-\u9fa5]|[0-9a-zA-Z_])+$/;
        regPwd = /^([0-9a-zA-Z_]){6,}$/;
        regEmail = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
        //验证之前将所有提示span内容清空
        if($(input[0]).val() == ''){
            //验证用户名
            $(input[0])[0].previousElementSibling.firstElementChild.innerText = '用户名不能为空';
            return;
        }else{
            $(input[0])[0].previousElementSibling.firstElementChild.innerText = '';
        }
        if(!regName.test($(input[0]).val())){
            //验证用户名
            $(input[0])[0].previousElementSibling.firstElementChild.innerText = '用户名格式有误（只能输入汉字、字母、数字和下划线）';
            return;
        }else{
            $(input[0])[0].previousElementSibling.firstElementChild.innerText = '';
        }
        if($(input[1]).val().length == 0){
            //验证邮箱
            $(input[1])[0].previousElementSibling.firstElementChild.innerText = '邮箱不能为空';
            return;
        }else{
            $(input[1])[0].previousElementSibling.firstElementChild.innerText = '';
        }
        if(!regEmail.test($(input[1]).val())){
            //验证邮箱
            $(input[1])[0].previousElementSibling.firstElementChild.innerText = '邮箱格式不正确';
            return;
        }else{
            $(input[1])[0].previousElementSibling.firstElementChild.innerText = '';
        }
        if(!regPwd.test($(input[2]).val())){
            //验证密码
            $(input[2])[0].previousElementSibling.firstElementChild.innerText = '密码至少为6位';
            return;
        }else{
            $(input[2])[0].previousElementSibling.firstElementChild.innerText = '';
        }
        if($(input[2]).val() != $(input[3]).val()){
            //验证再次密码
            $(input[3])[0].previousElementSibling.firstElementChild.innerText = '两次密码输入不一致';
            return;
        }else{
            $(input[3])[0].previousElementSibling.firstElementChild.innerText = '';
        }
        $(obj).attr('type','submit');
        obj.innerText = '确认注册';
    }else{
        $(obj).attr('type','button');
        document.getElementById('registform').submit();
        obj.innerText = '验证数据';
    }
}
var addFans = function (obj) {
    //判断是否登陆
    if($($(obj).parents('.WB_main_r')).children('#pl_login_form').length > 0){
        $(window).scrollTop(0);
        $($('.W_login_form').children('.login_prompt')).attr('style','display:inline-block');
        $($($('.W_login_form').children('.login_prompt'))).children('div').text('请先登录后再关注');
    }else{
        var name = $($(obj).parents('.con').children('.name')).children('.W_name').text();
        $.ajax({
            type:'get',
            url:'/home/addFans',
            data: 'name='+name,
            success:function(error){
                console.log(error)
                if (error == 1){
                    $('.out_biv').attr('style','display:inline-block');
                    $('.W_layer').attr('style','display:inline-block');
                    $($($($($('.W_layer').children('.content')).children('.W_layer_content')).children('.fans_status')).children('.fans_status_span')).text('关注成功');
                }else{
                    $('.out_biv').attr('style','display:none');
                    $('.W_layer').attr('style','display:none');
                    $($($($($('.W_layer').children('.content')).children('.W_layer_content')).children('.fans_status')).children('.fans_status_span')).text('关注失败');
                }
            },
            error:function (error) {
                alert('关注失败，刷新重试');
            }
        })
    }
}
var closediv = function () {
    $('.out_biv').attr('style','display:none');
    $('.W_layer').attr('style','display:none');
    window.location.href = location.href;
}

window.onkeydown = function(){
    $($('.W_login_form').children('.login_prompt')).attr('style','display:none');
    $($($('.W_login_form').children('.login_prompt'))).children('div').text('');
}
var doClose = function () {
    $($('.W_login_form').children('.login_prompt')).attr('style','display:none');
    $($($('.W_login_form').children('.login_prompt'))).children('div').text('');
}
var doEdit = function(obj){
    if ($($(obj).children('span')).text() != '保存'){
        $($(obj).parents('.infoblock')).children('.edit_info_div').attr('style','display:inline-block');
        $($(obj).parents('.infoblock')).children('.edit_info').attr('style','display:none');
        $($(obj).children('span')).text('保存');
        $($(obj).children('span')).attr('style','background-color:#ff8140;color:white');
        oldinfo = $($($($(obj).parents('.infoblock')).children('.edit_info_div')).children('.edit_info_form')).serialize();
    }else{
        var newinfo = $($($($(obj).parents('.infoblock')).children('.edit_info_div')).children('.edit_info_form')).serialize();
        if (oldinfo != newinfo){
            $.ajax({
                url : '/home/user/edit',
                type: 'post',
                data: newinfo,
                success:function (error) {
                    location.reload();
                },
                error:function () {
                    alert('修改失败，请刷新重试');
                    location.reload();
                }
            })
        }
    }
}
var editIcon = function () {
    $('.out_biv').attr('style','display:inline-block');
    $('.W_layer_div').attr('style','display:inline-block');
}
var closeIcon = function () {
    $('.out_biv').attr('style','display:none');
    $('.W_layer_div').attr('style','display:none');
    $('.addAlbum_div').attr('style','display:none');
    $($('#EditIcon_btn').children('span')).text('');
}
var doEditIcon = function (obj) {
    var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";
    var file = document.getElementById("EditIcon_input").value;
    var extName = file.substring(file.lastIndexOf(".")).toLowerCase();//（把路径中的所有字母全部转换为小写）
    if(!file){
        $('#EditIcon_form').attr('onsubmit','return false');
        $($('#EditIcon_btn').children('span')).text('(若取消请点击关闭)');
    }else if (AllImgExt.indexOf(extName+"|") == -1){
        $('#EditIcon_form').attr('onsubmit','return false');
        $($('#EditIcon_btn').children('span')).text('(仅支持图片)');
    }else{
        $('#EditIcon_form').attr('onsubmit','return true');
        $(document.getElementById("iconType_input")).val(extName);
        $("#EditIcon_form").submit()
        $($('#EditIcon_btn').children('span')).text('');
    }
}