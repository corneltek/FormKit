function formkit_init_datetime_widget() {
    $('.formkit-widget-datetime').each(function(){
        if( !$(this).attr('readonly') )
            $(this).datetimepicker({
                'showSecond': true,
                'ampm': $(this).data('ampm'),
                'dateFormat': $(this).data('date-format'),
                'timeFormat': $(this).data('time-format')
            });
    });
}
$(function(){

    $(document.body).ready(function() {
        formkit_init_datetime_widget();
    });
});
