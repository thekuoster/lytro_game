//TinyMCE Advanced WP Columns Plugin
(function() {    
    tinymce.create('tinymce.plugins.advanced_wp_columns_plugin', {
        init : function(ed, url){                        
            
            var isEditMode = function(){
                if(jQuery(ed.selection.getNode()).parents('.advanced_wp_columns_wrapper').first().length !== 0)
                {
                    return true;
                }else
                {
                    return false;
                }
            };
            
            ed.addCommand('mceColumns', function() {                
                var full_width = null;
                var gutter_width = null;
                var columns_number = null;
                
                var holder_class = null;
                var column_class = null;
                var gutter_class = null;
                
                var content_holder_node = null;
                var columns_content = [];                
                
                //check if someone click inside the previously inserted columns so we can open it for edit                
                if(isEditMode() === true)
                {
                    //Get content, width, gutter, columns number from DOM element  
                    content_holder_node = jQuery(ed.selection.getNode()).parents('.advanced_wp_columns_wrapper').first();
                    var columns = jQuery(content_holder_node).find('.advanced_wp_column');
                    
                    jQuery(columns).each(function(index, el){
                        columns_content.push(jQuery(el).html());
                    });
                    
                    columns_number = jQuery(columns).size();
                    full_width = jQuery(content_holder_node).width();
                    gutter_width = jQuery(content_holder_node).find('.advanced_wp_gutter').first().width();
                }else{
                    //get plugin settings trought ajax (if there is no previously selected content for editing)
                    jQuery.ajax({
                        type: "POST",
                        async: false,
                        url: ajaxurl, //this request will go trought wordpress
                        data: {
                            action: "advanced_wp_columns_plugin",
                            pluginRequest: 'settings' 
                        }, 
                        success: function(responseText){
                            try{
                                var settingsData = jQuery.parseJSON(responseText);
                                columns_number = settingsData.columns_number;
                                full_width = settingsData.full_width;
                                gutter_width = settingsData.gutter_width;
                                holder_class = settingsData.holder_class;
                                column_class = settingsData.column_class;
                                gutter_class = settingsData.gutter_class;
                            }catch(e) {
                            //TODO: 
                            //Nothing, this is just a wrapper to silently catch some exception
                            }
                        }
                    });                                 
                    
                }
                
                ed.windowManager.open({
                    title : 'Advanced WP Columns Manager',
                    file : url + '/advanced_wp_columns_plugin_popup_window.php',
                    width : 540,
                    height : 495,		                    
                    inline : 1								
                }, {
                    plugin_url : url,
                    plugin_params: {
                        selected_text : ed.selection.getContent({
                            format : 'text'
                        }),
                        columns_number: columns_number,
                        full_width: full_width,
                        gutter_width: gutter_width,
                        content_node: content_holder_node, //we are passing this parameter because IE couldn't get "tinyMCEPopup.editor.selection.getNode()" element from popup
                        columns_content: columns_content,
                        holder_class : holder_class,
                        column_class : column_class,
                        gutter_class : gutter_class                        
                    }
                });
            });
						
            ed.addButton('advanced_wp_columns_plugin', {
                title : 'Advanced Columns Manager',
                cmd : 'mceColumns',
                image: url + "/images/wp_columns.png"
            });		
            
            //event to monitor if user click inside the our content so we can 
            //do our stuff and prepare popup for edit mode, modify icon state etc.
            ed.onClick.add(function(ed) {
                if(isEditMode() === true)
                {
                    tinyMCE.activeEditor.controlManager.setActive('advanced_wp_columns_plugin', true);
                }else{   
                    tinyMCE.activeEditor.controlManager.setActive('advanced_wp_columns_plugin', false);
                }
            });
        },
        getInfo : function() {
            return {
                longname : 'Advanced WP Columns Plugin',
                author : 'Vladica Savic',
                authorurl : 'http://vladicasavic.iz.rs',
                infourl : 'http://wpcolumns.com',
                version : "1.0"
            };
        }
    });	
	
    tinymce.PluginManager.add('advanced_wp_columns_plugin', tinymce.plugins.advanced_wp_columns_plugin);
    
})();
