$(function(){
    $('.formkit-widget-date').each(function(){
        $(this).datepicker({
            dateFormat: $(this).data('date-format')
        });
    });
});
