
function formkit_init_date_widget() {
    $('.formkit-widget-date').each(function(){
        if( !$(this).attr('readonly') )
            $(this).datepicker({
                dateFormat: $(this).data('date-format')
            });
    });
}

(function($){
    $(document.body).ready(function() {
        formkit_init_date_widget();
    });
})(jQuery);
