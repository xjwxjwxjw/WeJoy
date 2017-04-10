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
	url = '/admin/newsIndex/';

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
			data: {id:""+tid+""},
			url:url+'delete/'+tid,
			success:function(data) {
				console.log(data);
				$('#task'+tid).remove();
				toastr.success(data);
			},
			error: function(data) {
				console.log(data);
                var errors = data.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , "Error " + data.status +': '+ errorThrown);
			}
		})
	})

	$('body').on('click','button.edit',function(){
		var tid = $(this).val();
		$.ajax({
			type: 'get',
			data:{id:""+tid+""},
			url:url+'edit/'+tid,
			success:function(data) {
				console.log(data);
				$datalist = data[0];
				$('#myModal').modal('show');
				$('#topic').val($datalist['topic']);
				$('#content').val($datalist['content']);
			},
			error: function() {
				
			}
		})
	})

	// $('#myModal').on('show.bs.modal', function (e) {
	// 	alert(1)
	// })

})