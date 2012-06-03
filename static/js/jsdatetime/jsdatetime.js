$(function(){
    $('.formkit-datetime').each(function(){
        $(this).datetimepicker({
            'showSecond': true,
            'ampm': $(this).data('ampm'),
            'dateFormat': $(this).data('date-format'),
            'timeFormat': $(this).data('time-format')
        });
    });
});
