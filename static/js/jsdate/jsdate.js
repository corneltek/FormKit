$(function(){
    $('.formkit-date').each(function(){
        $(this).datepicker({
            dateFormat: $(this).data('format')
        });
    });
});
