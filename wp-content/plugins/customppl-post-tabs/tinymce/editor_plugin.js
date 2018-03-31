// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('WPTS');
	
	tinymce.create('tinymce.plugins.WPTS', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mceWPTS', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					title: ed.getLang('WPTS.title','Insert Tabs'),
					width : 600 + ed.getLang('WPTS.delta_width', 0),
					height : 220 + ed.getLang('WPTS.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('WPTS', {
				title : 'Embed Youtube iframe',
				cmd : 'mceWPTS',
				image : url + '/tab.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('WPTS', n.nodeName == 'IMG');
			});
		},

		
		createControl : function(n, cm) {
			return null;
		},
		
		getInfo : function() {
			return {
					longname  : 'customppl',
					author 	  : 'customppl',
					authorurl : 'plan',
					infourl   : 'plan',
					version   : "1.1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('WPTS', tinymce.plugins.WPTS);
})();


