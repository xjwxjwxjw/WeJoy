var addAlbum = function () {
    $('.out_biv').attr('style','display:inline-block');
    $('.addAlbum_div').attr('style','display:inline-block');
}
var addPhotos = function () {
    $('.out_biv').attr('style','display:inline-block');
    $('.addPhoto_div').attr('style','display:inline-block');
}
var doAddAlbum = function (obj) {
    var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";
    var file = document.getElementById("AlbumFace_input").value;
    var extName = file.substring(file.lastIndexOf(".")).toLowerCase();//（把路径中的所有字母全部转换为小写）
    if($('#Album_name').parent().children('input').val() == ''){
        $($('#Album_name').children('span')).text('此项为必填');
        return;
    }else{
        $($('#Album_name').children('span')).text('');
    }
    if (AllImgExt.indexOf(extName+"|") == -1){
        $($('#Album_face').children('span')).text('仅支持图片');
        return;
    }else{
        $($('#Album_face').children('span')).text('');
    }
    $('#addAlbum_form').attr('onsubmit','return true');
    $(document.getElementById("facetype_input")).val(extName);
    $("#addAlbum_form").submit()
}
var doAddPhoto = function (obj) {
    var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";
    var file = document.getElementById("PhotosUrl_input").value;
    var extName = file.substring(file.lastIndexOf(".")).toLowerCase();//（把路径中的所有字母全部转换为小写）
    if (file == '' || file == null){
        $($('#Photos_img').children('span')).text('必须上传照片');
        return;
    }else{
        $($('#Photos_img').children('span')).text('');
    }
    if (AllImgExt.indexOf(extName+"|") == -1){
        $($('#Photos_img').children('span')).text('仅支持图片');
        return;
    }else{
        $($('#Photos_img').children('span')).text('');
    }
    $('#addPhoto_form').attr('onsubmit','return true');
    $(document.getElementById("facetype_input")).val(extName);
    $("#addPhoto_form").submit()
}
var changeAlbum = function (obj) {
    oldmassage = $(obj).children('div').text();
    objtype = $(obj).attr('name');
    $(obj).children('div')[0].innerHTML = '<input type="text" name="'+objtype+'" value="'+oldmassage+'" id="'+objtype+'">';
    //获取焦点到文字最后
    var t=$("#"+objtype).val();
    $("#"+objtype).val("").focus().val(t);

    //描述input失去焦点事件
    $("#AlbumDescription").blur(function(){
        var $_this = $(this);
        newmassage = $(this).val();
        if (newmassage == oldmassage){
            $(this).parent('div').text(oldmassage);
        }else{
            $.ajax({
                url:'/home/user/editDescription',
                data:'id='+$(this).parents('.ablum_div').attr('id').substr(6)+'&AlbumDescription='+newmassage,
                type:'get',
                success:function (error) {
                    if (error){
                        $_this.parent('div').text(newmassage);
                    }else{
                        $_this.parent('div').text(oldmassage);
                    }
                },
                error:function () {
                    alert('修改失败，请刷新重试');
                    location.reload();
                }
            })
        }
    });
    //名字input失去焦点事件
    $("#AlbumName").blur(function(){
        var $_this = $(this);
        newmassage = $(this).val();
        if (newmassage == oldmassage){
            $(this).parent('div').text(oldmassage);
        }else{
            $.ajax({
                url:'/home/user/editName',
                data:'id='+$(this).parents('.ablum_div').attr('id').substr(6)+'&AlbumName='+newmassage,
                type:'get',
                success:function (error) {
                    if (error){
                        $_this.parent('div').text(newmassage);
                    }else{
                        $_this.parent('div').text(oldmassage);
                    }
                },
                error:function () {
                    alert('修改失败，请刷新重试');
                    location.reload();
                }
            })
        }
    });
}
var changePhoto = function () {
    $.ajax({
        url:'/home/user/editPhotoes',
        type:'post',
        data:$('#edit_photo_form').serialize(),
        success:function (error) {
            if (error){
                location.reload();
            }else{
                location.reload();
            }
        },
        error:function () {
            alert('修改失败，请刷新重试');
            location.reload();
        }
    })
}
var delablum = function (obj) {
    if(confirm('确认删除？')){
        $.ajax({
            url:'/home/user/delAlbum',
            data:'id='+$(obj).parents('.ablum_div').attr('id').substr(6),
            type:'get',
            success:function (error) {
                if (error){
                    location.reload();
                }else{
                    alert('修改失败，请刷新重试');
                    location.reload();
                }
            },
            error:function () {
                alert('修改失败，请刷新重试');
                location.reload();
            }
        })
    }else{
        return;
    }
}
var delPhoto = function (obj) {
    if(confirm('确认删除？')){
        $.ajax({
            url:'/home/user/delPhoto',
            data:'id='+$(obj).parents('.photo_edit_div').attr('id').substr(15),
            type:'get',
            success:function (error) {
                if (error){
                    location.reload();
                }else{
                    alert('修改失败，请刷新重试');
                    location.reload();
                }
            },
            error:function () {
                alert('修改失败，请刷新重试');
                location.reload();
            }
        })
    }else{
        return;
    }
}
window.onload = function () {
    $('.setFace_btn').hover(function () {
        $(this).text('封面');
        $(this).attr('class','glyphicon setFace_btn');
    },function () {
        $(this).text('');
        $(this).attr('class','glyphicon glyphicon-thumbs-up setFace_btn');
    })
}
var setFace = function (obj) {
    $.ajax({
        url:'/home/user/setFace',
        data:'id='+$(obj).parents('.photo_edit_div').attr('id').substr(15)+'&aid='+location.pathname.substr(20,8),
        type:'get',
        success:function (error) {
            if (error){
                location.reload();
            }else{
                alert('设置失败，请刷新重试');
                location.reload();
            }
        },
        error:function () {
            alert('设置失败，请刷新重试');
            location.reload();
        }
    })
}


