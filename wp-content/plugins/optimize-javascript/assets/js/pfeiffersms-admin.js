(function($) {
$(document).ready(function($)
{
	/* $('#pfeiffersms-merge-script-option').change(function()
	{
		var $this = $(this),
			$next_tr = $this.parents('tr').eq(0).next();
		if ($this.val() == 0)
		{
			$('#pfeiffersms-minify-script-options').fadeOut('fast');
			$next_tr.fadeOut('fast');
		} else {
			$('#pfeiffersms-minify-script-options').fadeIn('fast');
			$next_tr.fadeIn('fast');
		}
	}); */
	
	$('#pfeiffersms-option-minify').change(function(){
		if ($(this).val() == 'minify-yui')
		{
			$('#pfeiffersms-check-exec').show();
		} else {
			$('#pfeiffersms-check-exec').hide();
		}
	});
	
	$('a.pfeiffersms-show-handles').click(function(){
		
		$(this).parent().next().fadeToggle();
		return false;
	})
	$('#pfeiffersms-check-exec').click(function(){
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			dataType: 'text',
			data: {
				action: 'pfeiffersms-check-exec',
				nonce: pfeiffersms.nonce
			},
			success: function(r) {
				
				console.log(r);
				
			},
			error: function(r) {
				$loader.hide();
				$submit.removeClass('button-disabled');
				$msg.html('An error accured').fadeIn('fast');
			}
		});
		return false;
	});
	
	$('#pfeiffersms-use-remote-files').change(function()
	{
		if (this.value == 3)
		{
			$('#pfeiffersms-local-copy-day').fadeIn('fast');
		} else {
			$('#pfeiffersms-local-copy-day').fadeOut('fast');
		}
	});
	
	$('#pfeiffersms-show-local-copy').click(function()
	{
		$('#pfeiffersms-list-local-copy').fadeToggle();
		return false;
	})
	
});
})(jQuery);