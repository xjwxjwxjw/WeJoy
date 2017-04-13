(function($) {
  'use strict';

  $(function() {
    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function() {
      $.AMUI.fullscreen.toggle();
      $.AMUI.fullscreen.isFullscreen ? $fullText.text('关闭全屏') : $fullText.text('开启全屏');
    });
  });
})(jQuery);


$(document).ready(function(){
	url = '/admin/permission/permission/';
  tid = 1;
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

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#task input[name="_token"]').val()
        }
    });

    $('body').on('click','#add',function(){
        $('#myModal').modal('show');
        $('#btn').addClass('add');
        $('#btn').removeClass('save');
        $('#name').val('');
				$('#content').val('');
				$('#content2').val('');
	  });

    $('body').on('click','button.add',function(){
      $('#myModal').modal('hide').removeClass('add');
      $.ajax({
        type: 'post',
        data: $('form').serialize(),
        url:url+'permission-add',
        success:function(data) {
          console.log(data);
          toastr.success('新增成功');
        },
        error:function(data) {
          console.log(data);
          toastr.error('新增失败');
        }
      })
    });

	$('body').on('click','button.delete',function(){
		var tid = $(this).val();
		$.ajax({
			type: 'get',
			data: {id:""+tid+""},
			url:url+'permission-delete/'+tid,
			success:function(data) {
				// console.log(data);
				$('#task'+tid).remove();
				toastr.success('删除成功');
			},
			error: function(data) {
				console.log(data);
        toastr.error( 'error');
			}
		})
	})

	$('body').on('click','button.edit',function(){
    $('#myModal').removeClass('add');
		tid = $(this).val();
    $.ajax({
			type: 'get',
			data:{id:""+tid+""},
			url:url+'permissionfind/'+tid,
			success:function(data) {
        console.log(data);
				$datalist = data[0];
        $('#myModal').modal('show');
				$('#btn').addClass('save');
        $('#name').val($datalist['name']);
				$('#content').val($datalist['display_name']);
				$('#content2').val($datalist['description']);
			},
			error: function() {

			}
		})
  })

  $('body').on('click','button.save',function(){
    $.ajax({
			type: 'post',
			data: $('form').serialize(),
			url:url+'permission-update/'+tid,
			success:function(data) {
        console.log(data);
				$('#myModal').modal('hide');
        $('#btn').removeClass('save');
        $datalist = data[0];
        var task = '<tr id="task' + $datalist['id'] + '">' +
                    '<td><input type="checkbox" /></td>'+
                    '<td>'+ $datalist['id'] +'</td>' +
                    '<td>'+ $datalist['name'] +'</td>' +
                    '<td>'+ $datalist['display_name'] +'</td>' +
                    '<td>'+ $datalist['description'] +'</td>' +
                    '<td>'+
                    "<button class='am-btn edit am-btn-default am-btn-xs am-text-secondary' value='" + $datalist['id'] + "'><span class='am-icon-pencil-square-o'></span> 修改</button>"+
                    "<button class='am-btn am-btn-default am-btn-xs am-text-danger delete' value='" + $datalist['id'] + "'><span class='am-icon-trash-o'></span> 删除</button>"+
                    '</td>' +
                    '<tr>';
        $('#task'+$datalist['id']).replaceWith(task);
        toastr.success('修改成功');
			},
			error: function() {
        toastr.error('修改失败');
			}
		})

	})

	// $('#myModal').on('show.bs.modal', function (e) {
	// 	alert(1)
	// })

})
