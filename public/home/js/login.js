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
            $(input[i-a]).prop('placeholder','不能为空');
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
            }
        },
        error:function (error) {
            alert('登陆失败，刷新重试');
            window.location = tourl;
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
