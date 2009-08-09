(function($) {
    $.fn.isrDialog = function(options) {
        var defaults = {
            sticky: true
        },
        overrides = {
            dragStop: function(e, ui) {
                if (isSticky(this)) {
                    var left = Math.floor(ui.position.left) - $(window).scrollLeft();
                    var top = Math.floor(ui.position.top) - $(window).scrollTop();
                    $(this).dialog('option', 'position', [left, top]);
                };
            }
        },
        settings = $.extend({}, defaults, options, overrides);

        this.each(function() {
            if ($(this).is('div')) {
                if ($(this).hasClass('ui-dialog-content'))
                    $(this).dialog(options);
                else
                    $(this).dialog(settings);
            };
        });
        if (window.__isrDialogWindowScrollHandled === undefined) {
            window.__isrDialogWindowScrollHandled = true;
            $(window).scroll(function(e) {
                $('.ui-dialog-content').each(function() {
                    if (isSticky(this)) {
                        var position = $(this).dialog('option','position');
                        $(this).dialog('option', 'position',position);
                    };
                });
            });
        };
        function isSticky(el) {
            return $(el).dialog('option', 'sticky') && $(el).dialog('isOpen');
        };
    };
})(jQuery); 
