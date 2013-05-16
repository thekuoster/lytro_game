<link rel="stylesheet" href="js/jQueryUI/themes/base/jquery.ui.all.css">
<script src="js/jQueryUI/jquery-1.7.2.js"></script>
<script src="js/jQueryUI/external/jquery.mousewheel-3.0.4.js"></script>
<script src="js/jQueryUI/ui/jquery.ui.core.js"></script>
<script src="js/jQueryUI/ui/jquery.ui.widget.js"></script>
<script src="js/jQueryUI/ui/jquery.ui.button.js"></script>
<script src="js/jQueryUI/ui/jquery.ui.spinner.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce_popup.js"></script>
<link rel="stylesheet" href="css/internal-plugin-style.css">
<script type="text/javascript" src="js/advanced_wp_columns_plugin_helpers.js"></script>
<script type="text/javascript" src="js/advanced_wp_columns_plugin_popup_window.js"></script>
<div class="title-label">Advanced WP Columns Manager</div>
<div id="designer-panel">
    <ul class="top-menu">
        <li class="left">
            <label for="columnsNumber">Columns number:</label>
            <input id="columnsNumber" name="columnsNumber">
        </li>
        <li class="left">
            <label for="fullWidth">Container width:</label>
            <input id="fullWidth" name="fullWidth">
        </li>
        <li class="left">
            <label for="gutterWidth">Gutter width:</label>
            <input id="gutterWidth" name="gutterWidth" value="20">
        </li>
    </ul>		
    <p class="clear"></p>		
    <div class="columns">
        <div class="content-holder-wrapper">				

        </div>
        <p class="clear">&nbsp;</p>
    </div>
    <div class="white clear">
        <div class="holder right-separator input-holder">
            <span class="header">Selected Plain Text</span>
            <p class="content-holder">
                <textarea id="selected_text" name="selected_text" contenteditable="true"></textarea>
            </p>
        </div>
    </div>
</div>
<div class="clear bottom-buttons-holder">	
    <button id="save" onClick="advancedColumns.SaveContent();" name="save">Save</button>
</div>