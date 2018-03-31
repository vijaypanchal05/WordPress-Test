<!DOCTYPE html>
<head>
	<title>Embed Youtube iframe</title>
	<link rel="stylesheet" href="<?= admin_url('load-styles.php?c=0&dir=ltr&load=admin-bar,buttons,media-views,wp-admin,wp-auth-check&ver=3.6.1') ?>" />
	<link rel="stylesheet" href="<?= includes_url('css/editor.min.css?ver=3.6.1') ?>" />
	<style>body {min-width:0}</style>
	<script type="text/javascript" src="<?= admin_url('load-scripts.php?c=0&load%5B%5D=jquery-core,jquery-migrate,utils,json2&ver=3.6.1') ?>"></script>
	<script type="text/javascript" src="<?= includes_url('js/tinymce/tiny_mce_popup.js') ?>"></script>
	<style>
		#wp-link-update {   			
    		float: none !important;
		}
		.tab-window span {
   			width: 130px !important;
            font-size: 16px;
            line-height: 16px;
           text-align: left;
        }
        .tab-window p {
    		text-align: center;
		}
#wp-link label input[type=text] {
    margin-top: 0; 
    width: 75%;
    height: 24px;
}
.mce-window iframe {
    width: 100%;
    height: 70% !important;
}
	</style>
	<script type="text/javascript">
		var FlynIFrame = {
			e: '',
			init: function(e) {
				FlynIFrame.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createIFrameShortcode(e) {
				var attribs = jQuery('#wp-link :input').serializeArray()

				var output = '[iframe ';
				for ( i=0; i<attribs.length; i++ )
					output += attribs[i].name + '="' + attribs[i].value.replace('"', "'") + '" ';

				output += ']';

				tinyMCEPopup.execCommand('mceReplaceContent', false, output);

				tinyMCEPopup.close();
			}
		}
		tinyMCEPopup.onInit.add(FlynIFrame.init, FlynIFrame);
	</script>
</head>
<body class="wp-core-ui" style="margin:0;overflow-x:scroll">
	<div id="wp-link-wrap" class="wp-core-ui search-panel-visible" style="display:block; width:100%; left:0; margin:0; box-shadow:none">
		<form id="wp-link">
			<div id="link-selector">
				<div id="link-options">
					<div class="tab-window">
						<label>
							<span>Enter Youtube Url:</span>
							<input id="url" name="src" type="text">
						</label>
							<p>e.g: https://www.youtube.com/watch?v=dW22dChgpRE</p>
					</div>
				</div>
			</div>
			<div class="submitbox" style="text-align: center;">
				<div id="wp-link-update">
					<input type="button" value="Add IFrame" class="button-primary" onclick="javascript:FlynIFrame.insert(FlynIFrame.e)">
				</div>
				<!-- <div id="wp-link-cancel">
					<a class="submitdelete deletion" href="#" onclick="tinyMCEPopup.close();">Cancel</a>
				</div> -->
			</div>
		</form>
	</div>

</body>
</html>