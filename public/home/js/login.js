var npclick = function(obj){
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
                alert('登陆成功');
                window.location = tourl;
                // $($('.W_login_form').parents('.login_box')).attr('style','display:none');

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