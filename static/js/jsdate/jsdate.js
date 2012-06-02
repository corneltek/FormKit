$(function(){
    $('.formkit-date').datepicker().each(function(){
        $(this).datepicker('option', 'dateFormat', $(this).data('format'));
    });
});
