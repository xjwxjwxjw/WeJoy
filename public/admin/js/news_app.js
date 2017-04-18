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
	url = '/admin/new/';

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

	$('body').on('click','button.delete',function(){
		var tid = $(this).val();
		$.ajax({
			type: 'get',
			url:url+'delete?id='+tid,
			success:function(data) {
				$('#task'+tid).remove();
				toastr.success('删除成功');
			},
			error: function(data) {
				toastr.error('删除失败');
			}
		})
	})

	$('body').on('click','button.edit',function(){
		var tid = $(this).val();
    var newstatus = $('#task'+tid).find('.edit').text();
    var html = "<span class='am-icon-pencil-square-o'></span>";
    if (newstatus == '显示') {
      newstatus = 1;
    } else {
      newstatus = 0;
    }
		$.ajax({
			type: 'get',
			url:url+'edit?id='+tid+"&status="+newstatus,
			success:function(data) {
        if (data == 0) {
          $text = $('#task'+tid).find('.edit').text('显示');
        } else {
          $text = $('#task'+tid).find('.edit').text('隐藏');
        }

			},
			error: function() {

			}
		})
	})

})
