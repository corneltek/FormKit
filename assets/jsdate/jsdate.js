(function($){
    function formkit_init_date_widget() {
        $('.formkit-widget-date').each(function(){
            $(this).datepicker({
                dateFormat: $(this).data('date-format')
            });
        });
    }
    $(function() {
        init_date_widget();
    });
})(jQuery);
