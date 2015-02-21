/**
 * Created by jerick on 1/16/2015.
 */
var jyd = {
    init: function(){
        jyd.initBlockUI();
        jQuery(document).ajaxStop(jQuery.unblockUI);
    },
    initBlockUI: function() {
        jQuery.blockUI.defaults.css.border= '0px solid transparent';
        jQuery.blockUI.defaults.css.backgroundColor= 'transparent';
        jQuery.blockUI.defaults.css.cursor= 'wait';
        jQuery.blockUI.defaults.css.textAlign= 'left';
        jQuery.blockUI.defaults.centerY = false;
        jQuery.blockUI.defaults.border= 'none';
        jQuery.blockUI.defaults.baseZ= 9999;
        jQuery.blockUI.defaults.ignoreIfBlocked = true;
        jQuery.blockUI.defaults.fadeOut = 800;
        jQuery.blockUI.defaults.fadeIn = 800;
    },
    loadingMessage: function(msg) {
        msg = msg ? msg : 'Please wait while we process your request.';
        return '<div class="img-rounded load_indicator" style="padding:5px 15px;background:#289ae3;color: #FFF;">' +
        '<h4 style="font-weight: bold; margin: 0px; padding: 4px 4px 4px 0px;"><i class="glyphicon glyphicon-cog"></i> Processing ... </h4>'+
        '<p  style="font-size:12px;"> '+msg+'</p></div>';
    }
}

jQuery(document).ready(function () {
    jyd.init();
});