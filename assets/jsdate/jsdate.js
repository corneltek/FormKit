
function formkit_init_date_widget() {
    $('.formkit-widget-date').each(function(){
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
