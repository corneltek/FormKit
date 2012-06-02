$(function(){
    $('.formkit-datetime').each(function(){
        $(this).datetimepicker({
            'showSecond': true,
            'dateFormat': $(this).data('date-format'),
            'timeFormat': $(this).data('time-format')
        });
    });
});
