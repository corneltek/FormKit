function formkit_init_datetime_widget() {
    $('.formkit-widget-datetime').each(function(){
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
