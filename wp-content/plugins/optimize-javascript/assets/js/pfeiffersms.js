jQuery(document).ready(function($)
{
	var $panel = $('#pfeiffersms-panel').hide();
	$('#wp-admin-bar-pfeiffersms-admin-bar').click(function()
	{
		$panel.slideToggle();
	});
	
	$('#pfeiffersms-adminbar-showinfo').click(function(){
		$('#pfeiffersms-adminbar-info').fadeToggle();
		return false;
	});

	$panel.find('a.submit').click(function()
	{
		$submit = $(this);
		if ($submit.hasClass('button-disabled'))
			return false;

		$submit.addClass('button-disabled');
		
		var $wrap = $('#pfeiffersms-submit-wrapper'),
			$loader = $wrap.find('.pfeiffersms-loader').show(),
			$msg 	= $wrap.find('.pfeiffersms-msg').html('').hide();
		
		$.ajax({
			type: 'POST',
			url: pfeiffersms.ajaxurl,
			dataType: 'text',
			data: {
				action: 'pfeiffersms-save-assets',
				nonce: pfeiffersms.nonce,
				input: $('#pfeiffersms-form').serialize()
			},
			success: function(r) {
				$loader.hide();
				console.log(r);
				$obj = $.parseJSON(r);
				$msg.html($obj.data.msg).fadeIn('fast');
				setTimeout(function()
				{
					$msg.fadeOut('fast');
					$submit.removeClass('button-disabled');
				}, 4000);
				
			},
			error: function(r) {
				$loader.hide();
				$submit.removeClass('button-disabled');
				$msg.html('An error accured').fadeIn('fast');
			}
		});
		return false;
	});
	
	var $not_merged = $('#pfeiffersms-notmerged');
	if ($not_merged.length > 0)
	{
		$not_merged.show().appendTo($('#wp-admin-bar-pfeiffersms-admin-bar').children().eq(0));
	}
});