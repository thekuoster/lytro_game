//TinyMCE Advanced WP Columns Plugin - Popup Window
//
//If you don't understand some parts here it doesnt matter, because its 
//not meant for you to understand.
$(function() {
    advancedColumns.Init({
        columns_number: tinyMCEPopup.params.plugin_params.columns_number,
        full_width: tinyMCEPopup.params.plugin_params.full_width,
        gutter_width: tinyMCEPopup.params.plugin_params.gutter_width,
        content_node: tinyMCEPopup.params.plugin_params.content_node,
        columns_content : tinyMCEPopup.params.plugin_params.columns_content,
        holder_class : tinyMCEPopup.params.plugin_params.holder_class,
        column_class: tinyMCEPopup.params.plugin_params.column_class,
        gutter_class: tinyMCEPopup.params.plugin_params.gutter_class
    });
        
    $( "#selected_text" ).html(tinyMCEPopup.params.plugin_params.selected_text);            
        
    //TRANSFORMATIONS
    $( "#columnsNumber").spinner({
        min: 0, 
        max: 20, 
        step: 1, 
        increment: 'fast', 
        value: advancedColumns.settings.columns_number,
        change: function(event, ui) {
            if(advancedColumns.settings.columns_number < this.value){
                advancedColumns.AddColumn();
            }else
            {
                var is_removed = advancedColumns.RemoveColumn();
                if(!is_removed)
                {
                    this.value = advancedColumns.settings.columns_number;
                }
            }
        }
    });	
         
    $("#fullWidth").val(advancedColumns.settings.full_width).change(function(){
        advancedColumns.settings.full_width = $(this).val()
    });
        
    $("#gutterWidth").val(advancedColumns.settings.gutter_width).change(function(){
        advancedColumns.settings.gutter_width = $(this).val()
    });       
        
    $( "button" ).button();	                	        
});
           
//POPUP WINDOW RESIZE MONITORING (must be improved somehow)    
$(window).resize(function(e) {                    
    advancedColumns.Resize();  
});
    
    
var advancedColumns = {
    settings : {
        columns_number: 2,            
        full_width: 600,
        gutter_width: 20,
        content_node: null,
        columns_content: [],
        holder_class: '',
        column_class: '',
        gutter_class: ''
    },
    Init : function(options)
    {
        this.settings = $.extend({}, this.settings, options); 
        var number_of_generated_columns = 0;
        while(number_of_generated_columns < this.settings.columns_number)
        {                
            var columnContent = (typeof this.settings.columns_content[number_of_generated_columns] !== 'undefined' && this.settings.columns_content[number_of_generated_columns] !== null)? this.settings.columns_content[number_of_generated_columns] : '';
            number_of_generated_columns++;
            this.RenderColumn(number_of_generated_columns, columnContent);
            this.Resize();                
        }
    },
    RenderColumn : function(columnIndex, columnContent)
    {            
        var additionalClass = ($('.columns .holder').size() == 0)?'':'left-separator';
        $("<div/>").addClass('holder left ' + additionalClass)
        .append($("<span/>").text(Number(columnIndex).ordinal() + ' column')
            .addClass('header'),$('<p/>').addClass('content-holder')
            .append($('<div/>').addClass('single_column_content').attr({
                "id":"single_column_content_"+columnIndex,
                "contenteditable":"true"
            }).html(columnContent)))
        .appendTo('.content-holder-wrapper');	            
    },
    Close : function()
    {
        if (tinyMCEPopup.isWindow){
            window.focus();
        }
        try{
            tinyMCEPopup.editor.focus();
            tinyMCEPopup.close();
        }catch(e){
        //IE sometimes throw exception here for no reason, so we prevent that                
        };
    },
    Resize : function()
    {			            
        if(this.settings.columns_number > 2)
        {
            $('.content-holder .single_column_content').css({
                'height':'125px'
            });                
        }else
        {
            $('.content-holder .single_column_content').css({
                'height':'145px'
            });                
        }
        var columns_width = (this.settings.columns_number * 267) - 5;
        $('.content-holder-wrapper').css({
            'width': columns_width+'px'
        });
        if($(tinyMCE.DOM.doc.getElementById(tinyMCEPopup.id)).width()<540)
        {
            $(tinyMCE.DOM.doc.getElementById(tinyMCEPopup.id)).width(540);
        }
        $('.input-holder').width($(tinyMCE.DOM.doc.getElementById(tinyMCEPopup.id)).width() - 35);
        $(tinyMCE.DOM.doc.getElementById(tinyMCEPopup.id)).height(520);
            
            
    },
    AddColumn : function()
    {
        this.settings.columns_number++;
        this.RenderColumn(this.settings.columns_number, '');
        this.Resize();	            
    },
    RemoveColumn: function(sender)
    {
        var is_removed = false;
        var _removeColumn = function(column_obj) {  
            advancedColumns.settings.columns_number--;
            $(column_obj).remove();
            advancedColumns.Resize();
            is_removed = true;
        };  
        if(sender){
            return;
        }
        if(this.settings.columns_number != 0)
        {
            var last_column = $(".content-holder-wrapper .holder").last();                
            if($(last_column).find('.content-holder .single_column_content').first().text()!="")
            {
                if (confirm('Column is not empty, do you realy want to remove it?')) { 
                    _removeColumn(last_column); 
                }
            }else
            {
                _removeColumn(last_column); 
            }               
        }
        return is_removed;
    },
    CalculateColumnWidth: function(columns_number, full_width, gutter_width){
        return ((full_width  - gutter_width * (columns_number - 1)) / columns_number);
    },
    SaveContent: function()
    {            
        var column_width = this.CalculateColumnWidth(advancedColumns.settings.columns_number, advancedColumns.settings.full_width, advancedColumns.settings.gutter_width);
            
        var content = null;
            
        var one_pixel_image = StringFormat('<img src="{0}/images/1x1-pixel.png" border="0" style="border: none;">', tinyMCEPopup.getWindowArg('plugin_url'));
        var column_template = '<div class="advanced_wp_column {0}" style="float:left;margin:0px;padding:0px;width:{1}px;">{2}</div>';
        var gutter_template = '<div class="advanced_wp_gutter {0}" style="float:left;margin:0px;padding:0px;width:{1}px;">{2}</div>';
            
        $(".single_column_content").each(function(index, element){
            $(this).find('img').each(function(index, image){                   
                $(this).removeAttr('width');
                $(this).removeAttr('height');               
                $(this).css({
                    'max-width':column_width+'px',
                    'height':'auto'
                });
            });
            var single_column_content = ($.trim($(this).html())!="") ? $(this).html() : one_pixel_image;
            if(content==null){
                content = StringFormat(column_template, advancedColumns.settings.column_class, column_width, single_column_content);
            }else{
                content = content + StringFormat(gutter_template, advancedColumns.settings.gutter_class, advancedColumns.settings.gutter_width, one_pixel_image);
                content = content + StringFormat(column_template, advancedColumns.settings.column_class, column_width, single_column_content);	
            }
        });
		
        if(content != null)
        {
            var wrapper_template = '<div class="advanced_wp_columns_wrapper {0}" style="margin:0px;padding:0px;width:{1}px;">{2}<div style="clear:both;">{3}</div></div>';
            content = StringFormat(wrapper_template, advancedColumns.settings.holder_class, advancedColumns.settings.full_width, content, one_pixel_image);
                
            //Here we check if user edit or insert new columns, so we can replace container element if is in edit mode
            if(this.settings.content_node != null && jQuery(this.settings.content_node).length !== 0)
            {
                jQuery(this.settings.content_node).remove();
            }
                
            tinyMCEPopup.execCommand('mceInsertContent', false, content);
			
            this.Close();
        }
    }	
}