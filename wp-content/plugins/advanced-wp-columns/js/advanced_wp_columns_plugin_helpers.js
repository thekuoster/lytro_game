//------------------------------------------------------------------------
//Helper Methods -->
//------------------------------------------------------------------------

Number.prototype.ordinal = function () {
    return this + (
        (this % 10 == 1 && this % 100 != 11) ? 'st' :
        (this % 10 == 2 && this % 100 != 12) ? 'nd' :
        (this % 10 == 3 && this % 100 != 13) ? 'rd' : 'th'
        );
}

var ResetInput = function(){
    jQuery('input, textarea').each(function() {
        jQuery(this).val('').text('');
    });
};

var StringFormat = function() {
    var s = arguments[0];
    for (var i = 0; i < arguments.length - 1; i++) {
        var regExpression = new RegExp("\\{" + i + "\\}", "gm");
        s = s.replace(regExpression, arguments[i + 1]);
    }
    return s;
}