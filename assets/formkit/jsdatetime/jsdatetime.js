FormKit.register(function(e,scopeEl) {
    $(scopeEl).find('.formkit-widget-datetime').each(function(){
        if( !$(this).attr('readonly') )
            $(this).datetimepicker({
                'showSecond': true,
                'ampm': $(this).data('ampm'),
                'dateFormat': $(this).data('date-format'),
                'timeFormat': $(this).data('time-format')
            });
    });
});
