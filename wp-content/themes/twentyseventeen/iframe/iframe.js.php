(function() {
     tinymce.create('tinymce.plugins.FlynIFramePlugin', {
          init : function(ed, url) {
               ed.addCommand('flyniframe', function() {
                    ed.windowManager.open({
                         file : "<?= admin_url('admin-ajax.php?action=flyniframe_tinymce_modal') ?>",
                         width : 650 + parseInt(ed.getLang('flyniframe.delta_width', 0)),
                         height : 250 + parseInt(ed.getLang('flyniframe.delta_height', 0)),
                         inline : 1
                    }, {
                         plugin_url : url
                    });
               });
               var stylesheet_directory_uri = "<?php echo get_stylesheet_directory_uri(); ?>";
               var imgpath = stylesheet_directory_uri + '/iframe.png';
               ed.addButton('flyniframe', {title : 'IFrame', cmd : 'flyniframe', image: imgpath});
          },
          getInfo : function() {
               return {
                    longname : 'Flynsarmy IFrame Plugin',
                    author : 'Flyn San',
                    authorurl : 'http://www.flynsarmy.com',
                    infourl : 'http://www.flynsarmy.com',
                    version : tinymce.majorVersion + "." + tinymce.minorVersion
               };
          }
     });
     tinymce.PluginManager.add('flyniframe', tinymce.plugins.FlynIFramePlugin);
})();