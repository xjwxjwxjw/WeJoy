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
	url = '/admin/advert/';
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
      $('#exampleModalLabel').text('添加广告信息');
        $('#myModal').modal('show');
        $('#btn').addClass('add');
        $('#btn').removeClass('save');
        $('#name').val('');
				$('#url').val('');
	  });

    $('body').on('click','button.add',function(){
      $('#myModal').modal('hide').removeClass('add');
      // $.ajax({
      //   type: 'post',
      //   data: $('form').serialize(),
      //   url:url+'advert-add',
      //   success:function(data) {
      //     toastr.success('新增成功');
      //   },
      //   error:function(data) {
      //     toastr.error('新增失败');
      //   }
      // })
    });

	$('body').on('click','button.delete',function(){
		var tid = $(this).val();
		$.ajax({
			type: 'get',
			data: {id:""+tid+""},
			url:url+'delete/',
			success:function(data) {
          $('#task'+tid).remove();
          toastr.success('删除成功');
			},
			error: function(data) {
        toastr.error( 'error');
			}
		})
	})

	$('body').on('click','button.edit',function(){
    $('#myModals').removeClass('add');
		tid = $(this).val();
    $.ajax({
			type: 'get',
			data:{id:""+tid+""},
			url:url+'advert/'+tid,
			success:function(data) {
				$datalist = data[0];
        $('#myModals').modal('show');
				$('#btn').addClass('save');
        $('#testform').attr({action: 'advert/advert-update/'+tid});
        $('#exampleModalLabel').text('修改广告信息');
        $('#name').val($datalist['name']);
        $('#url').val($datalist['url']);
			},
			error: function() {
        toastr.error( '刷新试试');
			}
		})
  })

  

	// $('#myModal').on('show.bs.modal', function (e) {
	// 	alert(1)
	// })

})
